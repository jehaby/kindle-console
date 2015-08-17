<?php namespace Jehaby\Kindle;


use Illuminate\Support\Collection;
use Jehaby\Kindle\Contracts\DateParser;
use Jehaby\Kindle\Contracts\HighlightCreator as HighlightCreatorContract;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class KindleHighlightCreator implements HighlightCreatorContract
{

    protected $bookCreator;

    protected $dateParser;


    public function __construct(KindleBookCreator $bookCreator = null, DateParser $dateParser = null) // TODO: code to interface??!
    {
        $this->logger = new Logger('first_logger');
        $this->logger->pushHandler(new StreamHandler('storage/logs/log_kindle_highlight_creator.log'));

        $this->bookCreator = $bookCreator ? $bookCreator : new KindleBookCreator();
        $this->dateParser = $dateParser ? $dateParser : new KindleDateParser();
    }


    /**
     * @return mixed
     */
    public function createHighlight($raw_data)
    {

        $res = array_filter(explode("\n", trim($raw_data)), function ($item) {
            return trim($item);
        });

        if (count($res) != 3) {
            $this->logger->addDebug('$res != 3 in createHighlight', ['raw_data' => $raw_data, 'res' => $res]);
            throw new \Exception("from parseRawHighlight, res != 3. Res: " . (new Collection($res))->toJson() . "; count(\$res) = " . count($res));
        }

        $text = trim($res[3], " \t\n\r\0\x0B.,?-!:.\";)(“”…�`'");

        $h = [
            'text' => mb_convert_encoding($text, 'UTF-8'),
            'book_id' => $this->bookCreator->parseBook(trim($res[0])), // TODO: think about it. Maybe it's better to store Book instance here?
            'type' =>  $this->detectType($text),
            'date_added' => $this->dateParser->parse($this->prepareDate($res[1])),
            'location' => $this->parseLocation($this->prepareLocation($res[1])),
        ];

        return new Highlight($h);

    }


    private function parseLocation($raw_location)
    {
        preg_match('/.* ([\d-]{1,15}) $/', $raw_location, $matches);
        return $matches[1];
    }


    /**
     * @param $text
     * @return int
     */
    private function detectType($text)
    {
        return str_contains(($text), ' ') ? Highlight::PHRASE : Highlight::WORD;
    }


    /**
     * @param $res
     * @return string
     */
    private function prepareDate($techInfo)
    {
        return substr($techInfo, strrpos($techInfo, '|'));
    }


    /**
     * @param $res
     * @return string
     */
    private function prepareLocation($techInfo)
    {
        return substr($techInfo, 0, strrpos($techInfo, '|'));
    }

}

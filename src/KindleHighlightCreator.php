<?php namespace Jehaby\Kindle;


use Illuminate\Support\Collection;
use Jehaby\Kindle\Contracts\DateParser;
use Jehaby\Kindle\Contracts\HighlightCreator as HighlightCreatorContract;


class KindleHighlightCreator implements HighlightCreatorContract
{

    protected $bookCreator;

    protected $dateParser;


    public function __construct(KindleBookCreator $bookCreator = null, DateParser $dateParser = null) // TODO: code to interface??!
    {
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

 //       $res = array_map('trim', $res);  // TODO: do I really need this?

        $i = 42;

        if (count($res) != 3) {
            throw new \Exception("from parseRawHighlight, res != 3. Res: " . (new Collection($res))->toJson() . "; count(\$res) = " . count($res));
        }

        $text = trim($res[3], " \t\n\r\0\x0B.,?-!:.\";)(“”…�`'");

        $h = [
            'text' => $text,
            'book_id' => $this->bookCreator->parseBook(trim($res[0])), // TODO: think about it. Maybe it's better to store Book instance here?
            'type' =>  $this->detectType($text),
            'date_added' => $this->dateParser->parse(substr($res[1], strrpos($res[1], '|'))),    // TODO: I guess this sucks and should be refactored
            'location' => $this->parseLocation(substr($res[1], 0, strrpos($res[1], '|'))),
        ];

        return new Highlight($h);

        return new Highlight([
            'text' => $text,
            'bookId' => $this->bookCreator->parseBook(trim($res[0])), // TODO: think about it. Maybe it's better to store Book instance here?
            'type' =>  $this->detectType($text),
            'dateAdded' => $this->parseDate(substr($res[1], strrpos($res[1], '|'))),    // TODO: I guess this sucks and should be refactored
            'location' => $this->parseLocation(substr($res[1], 0, strrpos($res[1], '|'))),
        ]);

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


}

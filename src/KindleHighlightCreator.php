<?php namespace Jehaby\Kindle;


use Illuminate\Support\Collection;
use Jehaby\Kindle\Contracts\HighlightCreator as HighlightCreatorContract;


class KindleHighlightCreator implements HighlightCreatorContract
{

    private $bookCreator;


    public function __construct(KindleBookCreator $bookCreator = null) // TODO: code to interface??!
    {
        $this->bookCreator = $bookCreator ? $bookCreator : new KindleBookCreator();
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
            throw new \Exception("from parseRawHighlight, res != 3. Res: " . (new Collection($res))->toJson() . "; count(\$res) = " . count($res));
        }

        $text = trim($res[3], " \t\n\r\0\x0B.,?-!:.\";)(“”…�`'");

        return new Highlight (
            $text,
            $this->bookCreator->createBook(trim($res[0])),
            $this->detectType($text),
            $this->parseDate(substr($res[1], strrpos($res[1], '|'))),    // TODO: I guess this is suck and should be refactored
            $this->parseLocation(substr($res[1], 0, strrpos($res[1], '|'))),
            $res[3]
        );
    }


    private function parseDate($raw_date)
    {
        preg_match('/ Added on (.*)[[:cntrl:]]?/', $raw_date, $matches);
        return $matches[1];
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

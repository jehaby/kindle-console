<?php namespace Jehaby\Kindle;


use Illuminate\Support\Collection;


/**
 * Class ClippingsParser
 * @package Jehaby\Kindle
 */
class ClippingsParser {

    static $count = 0;

    private $collection;


    private function processRawHighlight($item)
    {
        return array_filter(explode("\n", trim($item)), function($item) {

            return trim($item);// return trim($item) ? true : false;  is it the same for array_filter?

        } );
    }


    private function parseFile($file_content)
    {

        $raw_highlights = explode("==========", $file_content);

        $collection = new Collection();

        foreach ($raw_highlights as $key => $raw_highlight) {

            try {
                $collection->push($this->parseRawHighlight($raw_highlight));
            } catch (\Exception $e) {
                continue;
            }

            unset($raw_highlights[$key]);
        }

    }


    private function parseRawHighlight($raw_highlight){

        $res =  array_filter(explode("\n", trim($raw_highlight)), function($item) {
            return trim($item);
        } );

        if (count($res) != 3) {
            throw new \Exception("from parseRawHighlight, res != 3. Res: " . (new Collection($res))->toJson() .  "; count(\$res) = " . count($res) );
        }

        $text = trim($res[3], " \t\n\r\0\x0B.,?-!");

        extract($this->parseTechInfo($res[1]));

        return new Highlight (
            $text,
            $res[0],
            $this->detectType($text),
            $dateAdded,
            $location
        );

    }


    private function detectType($text)
    {
        return 'hz';
    }


    private function parseTechInfo($tech)
    {

        preg_match('/.*Location ([\d-]{1,15}) \| Added on (.*)[[:cntrl:]]?/', $tech, $matches);

        if (count($matches) !== 3)
            throw new \Exception('Something went wrong in parseTechInfo. Tech: ' . $tech);

        return [
            'location' => trim($matches[1]),
            'dateAdded' => trim($matches[2]),
        ];

    }



    /**
     * @param $file_content
     */
    function __construct($file_content)
    {
        $this->collection = $this->parseFile($file_content);
    }


    /**
     * @return mixed
     */
    public function getCollection()
    {
        return $this->collection;
    }




}
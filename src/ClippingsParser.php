<?php namespace Jehaby\Kindle;


use Illuminate\Support\Collection;


/**
 * Class ClippingsParser
 * @package Jehaby\Kindle
 */
class ClippingsParser {


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

        $collection = new HighlightsCollection();

        foreach ($raw_highlights as $key => $raw_highlight) {

            try {
                $collection->push($this->parseRawHighlight($raw_highlight));
            } catch (\Exception $e) {
                // TODO: log exception somewhere!
                continue;
            }

            unset($raw_highlights[$key]);
        }

        return $collection;
    }


    private function parseRawHighlight($raw_highlight)
    {

        $res =  array_filter(explode("\n", trim($raw_highlight)), function($item) {
            return trim($item);
        } );

        if (count($res) != 3) {
            throw new \Exception("from parseRawHighlight, res != 3. Res: " . (new Collection($res))->toJson() .  "; count(\$res) = " . count($res) );
        }

        $text = trim($res[3], " \t\n\r\0\x0B.,?-!:.\";)(“”…�`'");

        extract($this->parseTechInfo($res[1])); // TODO: is it very bad design?

        return new Highlight (
            $text,
            $res[0],
            $this->detectType($text),
            $dateAdded,
            $location,
            $res[3]
        );

    }


    private function detectType($text)
    {
        if (str_contains($text, ' ')) {
            return Highlight::PHRASE;
        }

        return Highlight::WORD;
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


    public function createCollection($file_content)
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
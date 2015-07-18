<?php namespace Jehaby\Kindle;


use Illuminate\Support\Collection;


/**
 * Class ClippingsParser
 * @package Jehaby\Kindle
 */
class ClippingsParser {


    /**
     * @var
     */
    private $collection;


    /**
     * @param $item
     * @return array
     */
    private function processRawHighlight($item)
    {
        return array_filter(explode("\n", trim($item)), function($item) {

            return trim($item);// return trim($item) ? true : false;  is it the same for array_filter?

        } );
    }


    /**
     * @param $file_content
     * @return HighlightsCollection
     */
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


    /**
     * @param $raw_highlight
     * @return Highlight
     * @throws \Exception
     */
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
            $this->parseBook($res[0]),
            $this->detectType($text),
            $dateAdded,
            $location,
            $res[3]
        );

    }


    /**
     * @param $text
     * @return int
     */
    private function detectType($text)
    {
        if (str_contains($text, ' ')) {
            return Highlight::PHRASE;
        }

        return Highlight::WORD;
    }


    /**
     * @param $tech
     * @return array
     * @throws \Exception
     */
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


    /**
     *
     * @param $raw_book
     */
    public function parseBook($raw_book)  // TODO: maybe move to book factory
    {
        // TODO: I should probably check for errors here (valid argument, etc)
//        preg_match('/(.*) \((.*)\)$/', $raw_book, $matches ); // TODO: test speed with other implementation (string search) Think about optimizing regex

  //      return new Book($matches[1], $matches[2]);
    }


}
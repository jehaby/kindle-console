<?php namespace Jehaby\Kindle;


use Illuminate\Support\Collection;
use Jehaby\Kindle\Contracts\BookCreator;
use Jehaby\Kindle\Contracts\HighlightCreator;


/**
 * Class ClippingsParser
 * @package Jehaby\Kindle
 */
class ClippingsParser implements Contracts\CollectionCreator{


    private $raw_books = [];


    /**
     * @var
     */
    private $collection;



    /**
     * ClippingsParser constructor.
     * @param array $raw_books
     */
    public function __construct(HighlightCreator $highlightCreator)
    {
        $this->highlightCreator = $highlightCreator;
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
                $collection->push($this->highlightCreator->createHighlight($raw_highlight));
            } catch (\Exception $e) {
                // TODO: log exception somewhere!
                continue;
            }

            unset($raw_highlights[$key]);
        }

        return $collection;
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




}
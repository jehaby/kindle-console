<?php namespace Jehaby\Kindle;


use Illuminate\Support\Collection;
use Jehaby\Kindle\Contracts\BookCreator;
use Jehaby\Kindle\Contracts\HighlightCreator;


/**
 * Class ClippingsParser
 * @package Jehaby\Kindle
 */
class ClippingsParser implements Contracts\CollectionCreator
{


    /**
     * @var
     */
    private $collection;



    /**
     * ClippingsParser constructor.
     * @param array $raw_books
     */
    public function __construct(HighlightCreator $highlightCreator = null)
    {
        $this->highlightCreator = $highlightCreator ? $highlightCreator : new KindleHighlightCreator();
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
        if (is_array($file_content)) {
            return new HighlightsCollection($file_content);  //  TODO: do I really need this? Maybe I have to combine this class with ClippingsParser
        }

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
<?php namespace Jehaby\Kindle;


use Illuminate\Support\Collection;
use Jehaby\Kindle\Contracts\BookCreator;
use Jehaby\Kindle\Contracts\HighlightCreator;


/**
 * Class KindleCollectionCreator
 * @package Jehaby\Kindle
 */
class KindleCollectionCreator implements Contracts\CollectionCreator
{

    /**
     * @var
     */
    private $collection;


    /**
     * KindleCollectionCreator constructor.
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
    protected function parseFile($file_content)
    {
        
        $raw_highlights = explode("==========", $file_content);

        $collection = new HighlightsCollection();

        foreach ($raw_highlights as $key => $raw_highlight) {

            try {

                $collection->push($this->highlightCreator->createHighlight($raw_highlight));

            } catch (\Exception $e) {
                // TODO: log exception somewhere! Think about its type!
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
     * @return HighlightsCollection
     */
    public function getCollection()
    {
        return $this->collection;
    }




}
<?php namespace Jehaby\Kindle;



/**
 * Class HighlightsCollectionFactory
 *
 * It should create a collection of Highlight objects from raw 'My Clippings File'
 * @package Jehaby\Kindle
 */
class HighlightsCollectionFactory {


    /**
     * @var
     */
    private $collectionCreator;


    /**
     * HighlightsCollectionFactory constructor. Can be used as Factory Method, I suppose.
     * @param $collectionCreator
     */
    public function __construct($collectionCreator = null)
    {

        $this->collectionCreator = $collectionCreator ? $collectionCreator :
            new ClippingsParser(new KindleHighlightCreator(new KindleBookCreator()));

    }


    /**
     * @param $text_content
     * @return HighlightsCollection
     */
    public function createCollection($text_content)
    {
        if (is_array($text_content)) {
            return new HighlightsCollection($text_content);
        }

        $this->collectionCreator->createCollection($text_content);
        return $this->collectionCreator->getCollection();
    }


}
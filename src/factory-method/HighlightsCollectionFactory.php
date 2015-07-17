<?php

use \Jehaby\Kindle;




/**
 * Class HighlightsCollectionFactory
 * which implements Factory Method Pattern.
 *
 */
class HighlightsCollectionFactory {


    private $collectionCreator;


    /**
     * Factory method
     */
    public function makeCollectionCreator($text_content)
    {
        $this->collectionCreator = new Kindle\ClippingsParser($text_content);
    }


    public function createCollection()
    {
        return $this->collectionCreator->createCollection();
    }



}
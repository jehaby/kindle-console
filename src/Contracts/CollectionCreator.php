<?php namespace Jehaby\Kindle\Contracts;
use Jehaby\Kindle\HighlightsCollection;


/**
 * Interface CollectionCreator
 */
interface CollectionCreator {


    /**
     * @param string @file_content
     * @return HighlightsCollection
     */
    public function createCollection($file_content);


}
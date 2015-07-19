<?php namespace Jehaby\Kindle\Contracts;


/**
 * Interface CollectionCreator
 */
interface CollectionCreator {


    /**
     * @return mixed
     */
    public function createCollection($file_content);


}
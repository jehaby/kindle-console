<?php namespace Jehaby\Kindle;


use Symfony\Component\Finder\Comparator\Comparator;

/**
 * Class DatabaseCollectionManager
 *
 * It should read colelction from DB
 * Write it to DB
 * Allow write custom collection
 * Compare collections (from DB and created from file ?)
 *
 *
 *
 *
 *
 *
 *
 * @package Jehaby\Kindle
 */
class DatabaseCollectionManager implements Contracts\CollectionCreator
{

    private $collection;


    /**
     * @return mixed
     */
    public function createCollection($file_content)
    {

        // TODO: Implement createCollection() method.
    }


    /**
     * Writes collection to database
     */
    public function writeCollection()
    {

    }


    /**
     * @return mixed
     */
    public function getCollection()
    {
        return $this->collection;
    }


    /**
     * @param mixed $collection
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }


    public function addHighlights(HighlightsCollection $collectionFromFile)
    {

    }


}
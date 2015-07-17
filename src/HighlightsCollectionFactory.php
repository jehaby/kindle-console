<?php namespace Jehaby\Kindle;


class HighlightsCollectionFactory {



    private $collectionCreator;


    /**
     * Factory method,
     */
    public function makeCollectionCreator()  // TODO: private or public?
    {
        $this->collectionCreator = new ClippingsParser();
    }


    public function createCollection($text_content)
    {
        if (is_array($text_content)) {
            return new HighlightsCollection($text_content);
        }

        $this->makeCollectionCreator();

        $this->collectionCreator->createCollection($text_content);
        return $this->collectionCreator->getCollection();


        die();
//        ---------------------------------------------------

        $this->makeCollectionCreator($text_content);
        $this->getCollection();


        // static method






    }



}
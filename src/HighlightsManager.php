<?php namespace Jehaby\Kindle;


use Illuminate\Support\Collection;


class HighlightsManager
{

    /**
     * @var Collection
     */
    private $collection;
    private $parser;


    function __construct($file_content)
    {
        $this->parser = new ClippingsParser($file_content);
        $this->collection = $this->parser->getCollection();
    }

    public function getBooks()
    {

    }

    
    public function groupByBooks()
    {
        return $this->collection->groupBy(function($highlight) {
            return $highlight->getBook();
        });
    }


    public function getWords()
    {

    }


    public function getCollocations()
    {

    }


    public function getPhrases()
    {

    }


}
<?php namespace Jehaby\Kindle;


use Illuminate\Support\Collection;


class HighlightsCollection extends Collection {


    private $parser;


    public function __construct($file_content)
    {
        if (is_array($file_content)) {
            parent::__construct($file_content);
            return;
        }
        
        $this->parser = new ClippingsParser($file_content);
        $this->items = $this->parser->getCollection()->toArray();
    }


    public function groupByBooks()
    {
        return (new Collection($this->items))->groupBy(function($highlight) {
            return $highlight->getBook();
        });
    }


    /*
      

     */
    public function getPhrases()
    {
        
    }

    public function getCollocations()
    {

    }

    public function getWords()
    {

    }


    public function getByType()
    {

    }

    
    public function getEnglish()
    {

    }

    
    public function getRussian()
    {

    }

    
    public function getFromBook($book)
    {

    }

    
    

}



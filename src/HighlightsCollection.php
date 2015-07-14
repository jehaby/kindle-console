<?php namespace Jehaby\Kindle;


use Illuminate\Support\Collection;


class HighlightsCollection extends Collection {


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
        return $this->filter(function($item) use ($book) {
            return trim($item->getBook()) == $book;
        }) ;
    }

    
    

}



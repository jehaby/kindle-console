<?php

require 'vendor/autoload.php';

use \Jehaby\Kindle;
use \Illuminate\Support\Collection;



class Client {


    private $factory;



    public function __construct() {

        $this->factory = new Kindle\HighlightsCollectionFactory();

    }

    public function doStuff()
    {

        $collection = $this->factory->makeCollection(file_get_contents('My Clippings.txt'));

        var_dump($collection->count());


        foreach ($collection->groupByBooks() as $key => $value) {
            echo $key . ' => ' . count($value) . "\n";
        }


        $fromBook = $collection->getFromBook('Pro Git');
        var_dump($fromBook->count());

        var_dump($fromBook->map(function(Kindle\Highlight $item) {
            return $item->getText();
        }));


    }



}



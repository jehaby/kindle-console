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


        $res = $collection->filter(function($item) {
            return preg_match('/[^a-zA-Z]/', $item->getText()) && ! strpos($item->getText(), ' ');
        });

        var_dump(count($res));
        print_r($res);


        die();

        $res = $collection->groupBy(function(Kindle\Highlight $item) {
            return $item->getText();
        })->filter(function($item) {
            return count($item) == 4;
        });

        var_dump(count($res));
        print_r($res);


        foreach ($collection->groupByBooks() as $key => $value) {
            echo trim($key) . ' => ' . count($value) . "\n";
        }


        $fromBook = $collection->getFromBook('Pro Git');
        var_dump($fromBook->count());

        var_dump($fromBook->map(function(Kindle\Highlight $item) {
            return $item->getText();
        }));


    }



}



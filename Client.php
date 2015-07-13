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

        var_dump($collection->getFromBook('Pro Git'));

        

        return;


        $manager = new Kindle\HighlightsManager(file_get_contents('My Clippings.txt'));

        foreach ($manager->groupByBooks() as $key => $value) {

            var_dump($key);
            echo $key . ' => ' . count($value) . "\n";


        }

    }



}



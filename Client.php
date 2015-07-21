<?php

require 'vendor/autoload.php';

use \Jehaby\Kindle;





class Client {


    private $factory;



    public function __construct() {

        $this->factory = new Kindle\HighlightsCollectionFactory();

    }

    public function doStuff()
    {

        var_dump(memory_get_peak_usage());
        var_dump(memory_get_peak_usage(true));


        $collection = $this->factory->createCollection(file_get_contents('My Clippings.txt'));

        $res = $collection->filter(function($item) {
            return substr_count($item->getText(), ' ') > 1;
        });

//        $res = $collection->phrases();

        $res = $collection->words()->english()->search('');


        var_dump(count($res));
        var_dump($res);

        var_dump(memory_get_peak_usage());
        var_dump(memory_get_peak_usage(true));


        die();




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



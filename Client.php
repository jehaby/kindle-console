<?php

require 'vendor/autoload.php';

use \Jehaby\Kindle;
use \Illuminate\Support\Collection;



class Client {

    public function doStuff()
    {
        $collection = new Kindle\HighlightsCollection(file_get_contents('My Clippings.txt'));

        foreach ($collection->groupByBooks() as $key => $value) {
            echo trim($key) . ' => ' . count($value) . "\n";
        }

        die();
        
        
        $manager = new Kindle\HighlightsManager(file_get_contents('My Clippings.txt'));
        
        foreach ($manager->groupByBooks() as $key => $value) {
            echo trim($key) . ' => ' . count($value) . "\n";

            
        }
        
    }



}



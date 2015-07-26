<?php

require 'vendor/autoload.php';

use \Jehaby\Kindle\KindleCollectionCreator;
use Carbon\Carbon;
use Jehaby\Kindle\Highlight;





class Client {




    private $factory;


    public function __construct()
    {
        $this->factory = new KindleCollectionCreator();
    }



    public function doStuff()
    {

        global $capsule;  // TODO: this is shame


        $f = function ($item) {
            return md5($item->text . $item->location);
        };



        var_dump(Highlight::all()->keyBy($f)->toArray());


        $manager = new \Jehaby\Kindle\DatabaseCollectionManager($capsule);

        $this->factory->createCollection(file_get_contents('My Clippings.txt'));

        $highlights = $this->factory->getCollection();

        var_dump($highlights->take(10)->keyBy($f)->toArray());



//        $manager->writeCollection($highlights, null);

        die();

//        $bookCreator = new Kindle\KindleBookCreator();
//        var_dump($bookCreator->parseBook("An Astronaut's Guide to Life on Earth (Chris Hadfield)"));
//        var_dump($bookCreator->getBooks());
//
//        die();

//        var_dump(memory_get_peak_usage());
//        var_dump(memory_get_peak_usage(true));


//
//        $h = new \Jehaby\Kindle\Highlight([
//            'location' => '12-34',
//            'text' => 'fuck',
//            'book_id' => '2',
//            'type' => 0,
//            'dateAdded' => null,
//        ]);
//
//        var_dump($h);
//
//        var_dump($h->text);
//
//        die();git




        $this->factory->createCollection(file_get_contents('My Clippings.txt'));

        $collection = $this->factory->getCollection();

//        var_dump($collection);


//        $res = $collection->filter(function($item) {
//            return substr_count($item->getText(), ' ') > 1;
//        });

//        $res = $collection->phrases();

        $res = $collection->phrases()->english()->toArray();

        var_dump(count($res));
        print_r($res);

//        var_dump(memory_get_peak_usage());
//        var_dump(memory_get_peak_usage(true));

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



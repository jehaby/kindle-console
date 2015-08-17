<?php

require 'vendor/autoload.php';

use \Jehaby\Kindle\KindleCollectionCreator;
use Jehaby\Kindle\DatabaseCollectionManager;

use Carbon\Carbon;
use Jehaby\Kindle\Highlight;
use Jehaby\Kindle\Book;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;




class Client {


    private $factory;


    public function __construct()
    {
        $this->factory = new KindleCollectionCreator();
    }





    public function doStuff()
    {

        $this->getCollectionFromFile();

        die();

        error_reporting(E_ALL);

        $res = $this->getCollectionFromDB()->values();

        $book_ids = $res->unique('book_id')->pluck('book_id');  // TODO: I NEED THIS
        $books = Book::query()->whereIn('id', $book_ids->toArray())->get()->keyBy('id');

//
//        var_dump($books->toArray());

//
//        echo json_encode($res->toArray());
//
//        echo '========================';
//
//        echo json_encode($books->toArray());
//
//        echo '========================';
//


//        var_dump($books->toJson());

        header('Access-Control-Allow-Origin: *');

        $json = json_encode([
            'highlights' => $res->toArray(),
            'books' => $books->toArray()
        ]);

        if (! $json) {
            var_dump(json_last_error());
            var_dump(json_last_error_msg());
        }

        file_put_contents('output.json', $json);

        echo($json);


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

        $collectionFromFile = $collection->phrases()->english()->toArray();

        var_dump(count($collectionFromFile));
        print_r($collectionFromFile);

//        var_dump(memory_get_peak_usage());
//        var_dump(memory_get_peak_usage(true));

        die();


        $collectionFromFile = $collection->filter(function($item) {
            return preg_match('/[^a-zA-Z]/', $item->getText()) && ! strpos($item->getText(), ' ');
        });

        var_dump(count($collectionFromFile));
        print_r($collectionFromFile);


        die();

        $collectionFromFile = $collection->groupBy(function(Kindle\Highlight $item) {
            return $item->getText();
        })->filter(function($item) {
            return count($item) == 4;
        });

        var_dump(count($collectionFromFile));
        print_r($collectionFromFile);

        foreach ($collection->groupByBooks() as $key => $value) {
            echo trim($key) . ' => ' . count($value) . "\n";
        }

        $fromBook = $collection->getFromBook('Pro Git');
        var_dump($fromBook->count());

        var_dump($fromBook->map(function(Kindle\Highlight $item) {
            return $item->getText();
        }));


    }

    private function getCollectionFromFile($filename = 'My Clippings.txt')
    {
        $this->factory->createCollection(file_get_contents($filename));
        $res = $this->factory->getCollection();
        var_dump($res);
    }


    public function getCollectionFromDB() {
        global $capsule;

        $manager = new DatabaseCollectionManager($capsule);
        return $manager->getCollection();
    }

    public function writeFromFileToDB($filename = 'MyClippings.txt')
    {
        global $capsule;

        $manager = new DatabaseCollectionManager($capsule);

        $this->factory->createCollection(file_get_contents('My Clippings.txt'));
        $collectionFromFile = $this->factory->getCollection();

        $manager->compare($collectionFromFile);

        $manager->writeCollection($manager->getDiff());
    }

    public function testLogger()
    {
        $log = new Logger('first_logger');
        $log->pushHandler(new StreamHandler('storage/logs/log101.log'));

        $log->addDebug('Hey!', get_object_vars($this));
    }


}



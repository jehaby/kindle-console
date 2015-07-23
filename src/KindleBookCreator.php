<?php

namespace Jehaby\Kindle;


class KindleBookCreator
{

//    private static $instance;

    private $books = [];


//
//    /**
//     * KindleBookCreator constructor.
//     */
//    private function __construct()
//    {
////        self::$books = Book::all()->keyBy('raw_data');
//    }
//
//
//    public static function getInstance()
//    {
//        return self::$instance ? self::$instance : self::__construct();
//    }


    /**
     * @return \Jehaby\Kindle\Book;
     */
    public function parseBook($raw_data)
    {

            if (! array_key_exists($raw_data, $this->books)) {  // TODO: think about speed here!

                if (str_contains($raw_data, '(')) {  // book with author   TODO: refactor to one regex, without if
                    preg_match('/(.*) \((.*)\)$/', $raw_data, $matches ); // TODO: test speed with other implementations (string search) Think about optimizing regex
                    $this->books[$raw_data] = new Book([
                        'title' => $matches[1],
                        'author' => $matches[2],
                        'raw_data' => $raw_data
                    ]);
                } else {  // book without author
                    $this->books[$raw_data] = new Book([
                        'title' => $raw_data,
                        'raw_data' => $raw_data
                    ]);          // TODO: I should probably check for errors here (valid argument, etc)
                }

            }

        return $raw_data;

    }


    /**
     * @return array
     */
    public function getBooks()
    {
        return $this->books;
    }



}

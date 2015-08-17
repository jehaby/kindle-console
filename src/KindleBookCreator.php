<?php

namespace Jehaby\Kindle;


class KindleBookCreator
{

//    private static $instance;

    protected $books;



    /**
     * KindleBookCreator constructor.
     */
    public function __construct()
    {
        $this->books = Book::all()->keyBy('raw_data');
    }


    /**
     * @return \Jehaby\Kindle\Book;
     */
    public function parseBook($raw_data) // TODO: there'is a possible write to DB in a loop. It should't be very often, but still maybe I should refactor it.
    {

        $raw_data = trim($raw_data);

        if (! isset($this->books[$raw_data])) {

            var_dump($raw_data);
            var_dump(bin2hex($raw_data));


            if (str_contains($raw_data, '(')) {  // book with author   TODO: refactor to one regex, without if
                preg_match('/(.*) \((.*)\)$/', $raw_data, $matches ); // TODO: test speed with other implementations (string search) Think about optimizing regex

                if (count($matches) != 3) {
                    var_dump($raw_data);
                    var_dump($matches);
                    die();   // TODO: better throw Exception here!
                }

                $this->books[$raw_data] = Book::create([
                    'title' => $matches[1],
                    'author' => $matches[2],
                    'raw_data' => $raw_data
                ]);
            } else {  // book without author
                $this->books[$raw_data] = Book::create([
                    'title' => $raw_data,
                    'raw_data' => $raw_data
                ]);          // TODO: I should probably check for errors here (valid argument, etc)
            }

        }

        return $this->books[$raw_data]->getKey();

    }


    /**
     * @return array
     */
    public function getBooks()
    {
        return $this->books;
    }



}

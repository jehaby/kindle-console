<?php

namespace Jehaby\Kindle;


class KindleBookCreator implements Contracts\BookCreator
{

    private static $books = [];


    /**
     * @return \Jehaby\Kindle\Book;
     */
    public function createBook($raw_data)
    {

        if (! array_key_exists($raw_data, self::$books)) {

            if (str_contains($raw_data, '(')) {  // book with author   TODO: refactor to one regex, without if
                preg_match('/(.*) \((.*)\)$/', $raw_data, $matches ); // TODO: test speed with other implementations (string search) Think about optimizing regex
                self::$books[$raw_data] = new Book($matches[1], $matches[2]);
            } else {  // book without author
                self::$books[$raw_data] = new Book($raw_data);          // TODO: I should probably check for errors here (valid argument, etc)
            }

        }

        return self::$books[$raw_data];

    }




}

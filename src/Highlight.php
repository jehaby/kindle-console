<?php namespace Jehaby\Kindle;


class Highlight
{

    private $location;

    private $text;

    private $book;

    private $type;

    private $dateAdded;


    function __construct($text, $book, $type, $dateAdded, $location)
    {

//        var_dump(func_get_args());

        $this->text = $text;
        $this->book = $book;
        $this->type = $type;
        $this->dateAdded = $dateAdded;
        $this->location = $location;

//        var_dump(func_get_args());
    }


}
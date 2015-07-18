<?php namespace Jehaby\Kindle;


class Book
{

    private $title;

    private $author;


    /**
     * Book constructor.
     * @param $title
     * @param $author
     */
    public function __construct($title, $author)
    {
        $this->title = $title;
        $this->author = $author;
    }

}
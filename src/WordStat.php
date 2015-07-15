<?php namespace Jehaby\Kindle;


class WordStat {

    private $count;
    private $items;

    public function __construct()
    {

    }


    public function getWords()
    {
        return $this->items;
    }

    public function getCount()
    {
        return $this->count;
    }

}
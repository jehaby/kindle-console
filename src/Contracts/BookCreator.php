<?php namespace Jehaby\Kindle\Contracts;


/**
 * Interface BookFactory
 * @package Jehaby\Kindle\Contracts
 */
interface BookCreator
{

    /**
     * @return \Jehaby\Kindle\Book;
     */
    public function createBook($raw_data);


}
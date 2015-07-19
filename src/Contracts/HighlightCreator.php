<?php


namespace Jehaby\Kindle\Contracts;


/**
 * Interface HighlightFactory
 * @package Jehaby\Kindle\Contracts
 */
interface HighlightCreator
{

    /**
     * @return mixed
     */
    public function createHighlight($raw_data);


}
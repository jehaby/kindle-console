<?php

namespace Jehaby\Kindle\Controllers;


use Symfony\Component\HttpFoundation\Request;
use Jehaby\Kindle\DatabaseCollectionManager;


class ApiController {


    public function __construct(DatabaseCollectionManager $databaseManager = null)
    {
        $this->databaseManager = $databaseManager ? $databaseManager : new DatabaseCollectionManager();
    }


    public function index(Request $request)
    {
        return $this->databaseManager->getCollection()->toArray();
    }


    public function search($word)
    {

    }


    public function fromBook($book)  // $book id or what? how to do several books?  id better!
    {

    }


    public function byType($type)  // type format? id or string? string better!
    {

    }


    public function onlyWords()
    {
        
    }


    public function onlyPhrases()
    {

    }



}
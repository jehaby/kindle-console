<?php

require 'vendor/autoload.php';

use \Jehaby\Kindle;
use \Illuminate\Support\Collection;



class Client {


    public function doStaff() {

        $parser = new Kindle\ClippingsParser(file_get_contents('My Clippings.txt'));

//        $parser->getCollection();

    }


}



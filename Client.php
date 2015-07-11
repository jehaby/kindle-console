<?php

require 'vendor/autoload.php';

use \Jehaby\Kindle;
use \Illuminate\Support\Collection;



class Client {


    public function doStaff() {

        $collection = new Collection([1, 23,89, 83]);

        $collection->slice(1,2, true);

        var_dump($collection);

    }


}

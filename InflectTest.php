<?php

require 'vendor/autoload.php';

use \Jehaby\Kindle;
use \Illuminate\Support\Collection;


function test ($word) {
    var_dump($word . ' => ' . Kindle\Inflect::singularize($word));
}

test('dyes');

test('ant lions');


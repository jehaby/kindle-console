<?php



require 'vendor/autoload.php';
include "src/Book.php";

use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Jehaby\Kindle\Book;
use Jehaby\Kindle\Highlight;


$capsule = new Capsule();

$capsule->addConnection([
    'driver' => 'sqlite',
    'database' => 'storage/database.sqlite',
//    'prefix'   => '',
]);



$capsule->setEventDispatcher(new Dispatcher(new Container));


$capsule->bootEloquent();

$capsule->setAsGlobal();

dropTables($capsule);
createTables($capsule);
fillTables($capsule);




var_dump(Book::find(2));


// ------------------------------------------------------- //


function dropTables(Capsule $capsule)
{
    $capsule->schema()->dropIfExists('highlights');
    $capsule->schema()->dropIfExists('books');
}


function createTables(Capsule $capsule)
{
    if (! $capsule->schema()->hasTable('highlights')) {

        $capsule->schema()->create('highlights', function(\Illuminate\Database\Schema\Blueprint $table) {

            $table->increments('id');
            $table->string('text');
            $table->string('location');
            $table->tinyInteger('type');
            $table->dateTimeTz('dateAdded'); // TODO: figure out how to use it. Think about naming
            $table->integer('book_id')->unsigned();

            $table->foreign('book_id')->references('id')->on('books');
            $table->index('text');

        });

    }


    if (! $capsule->schema()->hasTable('books')) {

        $capsule->schema()->create('books', function($table) {

            $table->increments('id');
            $table->string('title');
            $table->string('author');

        });

    }

}


/**
 * @param $capsule
 */
function fillTables($capsule)
{
    $capsule->table('books')->insert(
        [
            [
                'author' => 'Mark Twain',
                'title' => 'Gek Finn',
            ],
            [
                'author' => 'Ayn Rand',
                'title' => 'Atlas Shrugged',
            ]
        ]
    );
}


<?php


require_once 'vendor/autoload.php';
require_once "src/Book.php";

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



//createTables($capsule);
//fillTables($capsule);
//
//
//var_dump(Book::find(2));


// ------------------------------------------------------- //

function createTables(Capsule $capsule)
{
    $capsule->schema()->dropIfExists('highlights');
    $capsule->schema()->dropIfExists('books');

    if (! $capsule->schema()->hasTable('highlights')) {

        $capsule->schema()->create('highlights', function(\Illuminate\Database\Schema\Blueprint $table) {

            $table->increments('id');
            $table->string('text');
            $table->string('location');
            $table->tinyInteger('type');
            $table->string('date_added'); // TODO: figure out how to use it. Think about naming
            $table->integer('book_id')->unsigned();

            $table->foreign('book_id')->references('id')->on('books');
            $table->unique(['text', 'location', 'book_id']);
            $table->index('text');

        });
    }


    if (! $capsule->schema()->hasTable('books')) {

        $capsule->schema()->create('books', function($table) {

            $table->increments('id');
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('raw_data');

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
                'author' => 'Charles Bukowski',
                'title' => 'Post Office',
                'raw_data' => 'Post Office (Charles Bukowski)'
            ],
            [
                'author' => 'Kahneman, Daniel',
                'title' => 'Thinking, Fast and Slow',
                'raw_data' => 'Thinking, Fast and Slow (Kahneman, Daniel)'
            ]
        ]
    );
}


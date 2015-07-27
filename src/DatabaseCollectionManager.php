<?php namespace Jehaby\Kindle;


use Symfony\Component\Finder\Comparator\Comparator;

/**
 * Class DatabaseCollectionManager
 *
 * It should read colelction from DB
 * Write it to DB
 * Allow write custom collection
 * Compare collections (from DB and created from file ?)
 *
 *
 *
 *
 *
 *
 *
 * @package Jehaby\Kindle
 */
class DatabaseCollectionManager
{

    /**
     * @var
     */
    protected $collection;


    /**
     *
     * @var
     */
    protected $diff;


    /**
     * @var
     */
    protected $capsule;


    protected $keyGenerator;


    /**
     * DatabaseCollectionManager constructor.
     * @param $capsule
     */
    public function __construct($capsule)
    {
        $this->capsule = $capsule;

        $this->keyGenerator = function ($item)
        {
            return md5($item->text . $item->location);
        };

        $this->collection = Highlight::all()->keyBy($this->keyGenerator);  // TODO: do I need to move it to createCollection method?
    }

    /**
     * DatabaseCollectionManager constructor.
     * @param $collection
     */



    /**
     * Writes collection to database
     */
    public function writeCollection(HighlightsCollection $highlights, HighlightsCollection $books = null)
    {

//        var_dump($highlights->chunk(100)->toArray());
//        die();

        var_dump(Highlight::all()->all());

        die();


        $this->capsule->table('highlights')->insert(
            $highlights->chunk(5)[2]->toArray()
        );

        // first writes books, then highlights
    }

    /**
     * @return mixed
     */
    public function getDiff()
    {
        return $this->diff;
    }


    /**
     * @return mixed
     */
    public function getCollection()
    {
        return $this->collection;
    }


    /**
     * @param mixed $collection
     */
    public function setCollection($collection)  // TODO: do I need this?
    {
        $this->collection = $collection;
    }


    /**
     * Compares with collection from file
     *
     * @param $collectionFromFile
     */
    public function compare(HighlightsCollection $collectionFromFile)
    {
        $this->diff = new HighlightsCollection();

        $collectionFromFile = $collectionFromFile->keyBy($this->keyGenerator);

        foreach ($collectionFromFile as $key => $item) {

            if (! isset($this->collection[$key])) {
                $this->diff->put($key, $item);
            }
        }
    }



    /**
     * @param HighlightsCollection $collectionFromFile
     */
    public function addHighlights(HighlightsCollection $collectionFromFile)
    {

    }


}
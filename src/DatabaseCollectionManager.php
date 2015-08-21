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
     *  Contains new item. It's populated in compare method.
     * @var HighlightsCollection
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
    public function __construct(\Illuminate\Database\Capsule\Manager $capsule)
    {
        $this->capsule = $capsule;

        $this->keyGenerator = function ($item)
        {
            return md5($item->getAttributes()['text'] . $item->location);  // TODO: add book info; TODO2 why $item->text doesn't work?
        };

        $this->collection = Highlight::all()->keyBy($this->keyGenerator);  // TODO: do I need to move it to createCollection method?
    }


    /**
     * Writes collection to database
     */
    public function writeCollection(HighlightsCollection $highlights = null, HighlightsCollection $books = null)
    {

        foreach($this->diff->chunk(50)->toArray() as $chunk) {   // TODO: think about chunks number. Think about speed and memory!
            $this->capsule->table('highlights')->insert($chunk);
        }

    }


    /**
     * @return HighlightsCollection
     */
    public function getDiff()
    {
        return $this->diff;
    }


    /**
     * @return HighlightsCollection
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
    public function createDiffCollection(HighlightsCollection $collectionFromFile)
    {
        $this->diff = new HighlightsCollection();

        foreach ($collectionFromFile->keyBy($this->keyGenerator) as $key => $item) {
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
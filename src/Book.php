<?php namespace Jehaby\Kindle;


use Illuminate\Database\Eloquent\Model;


class Book extends Model
{

    protected $guarded = [];

    private $title;

    private $author;

    private $raw_data;


    public function highlights()
    {
        return $this->hasMany('Highlight');
    }


//    /**
//     * Book constructor.
//     * @param $title
//     * @param $author
//     */
//    public function __construct($title, $author = null)
//    {
//        $this->title = $title;
//        $this->author = $author;
//    }

//    /**
//     * @return string
//     */
//    public function getTitle()
//    {
//        return $this->title;
//    }
//
//    /**
//     * @return string|null  // TODO: is it so bad to return null? Maybe return empty string or some constant?
//     */
//    public function getAuthor()
//    {
//        return $this->author;
//    }




}
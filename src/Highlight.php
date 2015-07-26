<?php namespace Jehaby\Kindle;

use Illuminate\Database\Eloquent\Model;


class Highlight extends Model
{

    const WORD = 0;
    const PHRASE = 1;

    protected $guarded = [];


    protected $location;

    protected $text;

    protected $bookId;

    protected $type;

    protected $dateAdded;

    protected $isPluralized; // only for word!


    public function book()
    {
        return $this->belongsTo('Book');
    }


    public function isWord()
    {
        return $this->attributes['type'] === SELF::WORD;
    }

    public function isPhrase()
    {
        return $this->attributes['type'] === SELF::PHRASE;
    }


    public function getKey()
    {
        return $this->text;
    }



}
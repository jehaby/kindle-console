<?php namespace Jehaby\Kindle;

use Illuminate\Database\Eloquent\Model;


class Highlight extends Model
{

    const WORD = 0;
    const PHRASE = 1;


    private $location;

    private $text;

    private $book;

    private $type;

    private $dateAdded;

    private $isPluralized; // only for word!


//    function __construct($text, $book, $type, $dateAdded, $location, $originalText = '')
//    {
//
////        var_dump(func_get_args());
//
//        $this->text = $text;
//        $this->book = $book;
//        $this->type = $type;
//        $this->dateAdded = $dateAdded;
//        $this->location = $location;
//        $this->originalText = $originalText;
//
////        var_dump(func_get_args());
//    }

//
//    public function getBook()
//    {
//        return $this->book;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getLocation()
//    {
//        return $this->location;
//    }
//
//    /**
//     * @return string
//     */
//    public function getText()
//    {
//        return $this->text;
//    }
//
//    /**
//     * @return string
//     */
//    public function getType()
//    {
//        return $this->type;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getDateAdded()
//    {
//        return $this->dateAdded;
//    }

    public function isWord()
    {
        return $this->type === SELF::WORD;
    }

    public function isPhrase()
    {
        return $this->type === SELF::PHRASE;
    }




}
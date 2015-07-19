<?php

namespace spec\Jehaby\Kindle;

use Jehaby\Kindle\Book;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClippingsParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Jehaby\Kindle\ClippingsParser');
    }


    function it_parses_book (Book $book)
    {
        $this
            ->parseBook("An Astronaut's Guide to Life on Earth (Chris Hadfield)")
            ->shouldBeLike(new Book("An Astronaut's Guide to Life on Earth", "Chris Hadfield"));
    }


    function it_parses_tech_info($raw_info)
    {
        $this
            ->parseTechInfo("- Your Highlight Location 394-394 | Added on Monday, 15 June 15 17:23:17")
            ->shouldBeLike([
                'location' => '394-394',
                'dateAdded' => 'Monday, 15 June 15 17:23:17'
            ]);
    }



}

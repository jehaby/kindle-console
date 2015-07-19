<?php

namespace spec\Jehaby\Kindle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Jehaby\Kindle\Book;



class KindleBookCreatorSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('Jehaby\Kindle\KindleBookCreator');
    }

    
    function it_parses_austronaut_book ()
    {
        $this
            ->createBook("An Astronaut's Guide to Life on Earth (Chris Hadfield)")
            ->shouldBeLike(new Book("An Astronaut's Guide to Life on Earth", "Chris Hadfield"));
    }

    function it_parses_post_office_book ()
    {
        $this
            ->createBook("Post Office (Charles Bukowski)")
            ->shouldBeLike(new Book("Post Office", "Charles Bukowski"));
    }


    function it_parses_book_without_author ()
    {
        $this
            ->createBook("The New Oxford American Dictionary")
            ->shouldBeLike(new Book("The New Oxford American Dictionary"));
    }


}

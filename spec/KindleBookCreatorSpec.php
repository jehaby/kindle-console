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
            ->parseBook("An Astronaut's Guide to Life on Earth (Chris Hadfield)")
            ->shouldReturn("An Astronaut's Guide to Life on Earth (Chris Hadfield)");

        $this->getBooks()->shouldBeLike([

            "An Astronaut's Guide to Life on Earth (Chris Hadfield)" =>
                new Book([
                    'title' => "An Astronaut's Guide to Life on Earth",
                    'author' => 'Chris Hadfield',
                    'raw_data' => "An Astronaut's Guide to Life on Earth (Chris Hadfield)",
                ]),

        ]);
    }

    function it_parses_two_books ()
    {

        $this
            ->parseBook("An Astronaut's Guide to Life on Earth (Chris Hadfield)")
            ->shouldReturn("An Astronaut's Guide to Life on Earth (Chris Hadfield)");

        $this->parseBook("Post Office (Charles Bukowski)")->shouldReturn("Post Office (Charles Bukowski)");



        $this->getBooks()->shouldBeLike([

            "An Astronaut's Guide to Life on Earth (Chris Hadfield)" =>
                new Book([
                    'title' => "An Astronaut's Guide to Life on Earth",
                    'author' => 'Chris Hadfield',
                    'raw_data' => "An Astronaut's Guide to Life on Earth (Chris Hadfield)",
                ]),

            "Post Office (Charles Bukowski)" =>
                new Book([
                    'title' => "Post Office",
                    'author' => 'Charles Bukowski',
                    'raw_data' => "Post Office (Charles Bukowski)",
                ]),

        ]);


// Doesn't work, because it is looking for specific objects, as I think. Don't know how to fix it yet.
//        $this->getBooks()->shouldHaveKeyWithValue(
//            "An Astronaut's Guide to Life on Earth (Chris Hadfield)",
//            new Book([
//                'title' => "An Astronaut's Guide to Life on Earth",
//                'author' => 'Chris Hadfield',
//                'raw_data' => "An Astronaut's Guide to Life on Earth (Chris Hadfield)",
//            ]));


    }


    function it_parses_book_without_author ()
    {
        $this->parseBook("The New Oxford American Dictionary")->shouldReturn("The New Oxford American Dictionary");

        $this->getBooks()->shouldBeLike([

            "The New Oxford American Dictionary" =>
                new Book([
                    'title' => "The New Oxford American Dictionary",
                    'raw_data' => "The New Oxford American Dictionary",
                ]),

        ]);


    }


}

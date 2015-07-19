<?php

namespace spec\Jehaby\Kindle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClippingsParserSpec extends ObjectBehavior
{

    function it_is_initializable(\Jehaby\Kindle\KindleHighlightCreator $highlightCreator)
    {
        $this->beConstructedWith($highlightCreator);
        $this->shouldHaveType('Jehaby\Kindle\ClippingsParser');
    }

}

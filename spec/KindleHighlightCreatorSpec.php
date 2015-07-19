<?php

namespace spec\Jehaby\Kindle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class KindleHighlightCreatorSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('Jehaby\Kindle\KindleHighlightCreator');
    }


}

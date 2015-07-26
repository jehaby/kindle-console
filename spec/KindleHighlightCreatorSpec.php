<?php

namespace spec\Jehaby\Kindle;

use Jehaby\Kindle\Highlight;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class KindleHighlightCreatorSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('Jehaby\Kindle\KindleHighlightCreator');
    }



    function it_creates_highlight_object_1()
    {

        $raw_data =     "
﻿Post Office (Charles Bukowski)
- Your Highlight on Page 12 | Location 184-184 | Added on Thursday, November 03, 2011, 06:29 AM

parish
";


        $this->createHighlight($raw_data)->shouldBeLike(new Highlight(['
        ']));
    }




}

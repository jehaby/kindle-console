<?php

namespace spec\Jehaby\Kindle;

use Carbon\Carbon;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class KindleDateParserSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('Jehaby\Kindle\KindleDateParser');
    }


    function it_parses_date()
    {
        $this->parse("| Added on Tuesday, November 01, 2011, 08:48 AM\n")
            ->shouldBeLike(Carbon::create(2011, 11, 1, 8, 48));
    }

}

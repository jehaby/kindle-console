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


    function it_parses_date2()
    {
        $this->parse("| Added on Saturday, 1 March 14 01:47:03")
            ->shouldBeLike(Carbon::create(2014, 3, 1, 1, 47, 03));
    }

    function it_parses_date3()
    {
        $this->parse("| Added on Friday, November 04, 2011, 11:53 PM\r")
            ->shouldBeLike(Carbon::create(2011, 11, 4, 23, 53));
    }





}

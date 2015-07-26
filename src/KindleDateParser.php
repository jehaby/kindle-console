<?php

namespace Jehaby\Kindle;

use Jehaby\Kindle\Contracts\DateParser;
use Carbon\Carbon;

class KindleDateParser implements DateParser
{

    public function parse($raw_date)
    {

        return Carbon::createFromFormat(
            'M d, Y, g:i a',
            trim(explode(',', $raw_date, 2)[1])
        );

    }
}

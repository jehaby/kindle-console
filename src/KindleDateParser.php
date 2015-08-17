<?php

namespace Jehaby\Kindle;

use Jehaby\Kindle\Contracts\DateParser;
use Carbon\Carbon;

class KindleDateParser implements DateParser
{

    public function parse($raw_date)
    {

        if (preg_match('/AM|PM$/', $raw_date)) {

            return Carbon::createFromFormat(
                'M d, Y, g:i a',
                trim(explode(',', $raw_date, 2)[1])
            );

        } else {  //1 March 14 01:49:41
            return Carbon::createFromFormat(
                'd M y H:i:s',
                trim(explode(',', $raw_date, 2)[1])
            );
        }

    }
}

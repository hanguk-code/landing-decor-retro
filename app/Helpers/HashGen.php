<?php

namespace App\Helpers;

use Carbon\Carbon;

final class HashGen
{
    private $hash;

    public function __construct()
    {
        $date = Carbon::now();
        $hash = md5($date);
        $this->hash = substr($hash, 0, 12);
    }

    public function make()
    {
        return $this->hash;
    }

}

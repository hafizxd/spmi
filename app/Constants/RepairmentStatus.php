<?php

namespace App\Constants;

use App\Constants\BaseConstant;

class RepairmentStatus extends BaseConstant
{
    const NOT = 1;
    const DONE = 2;


    public static function labels()
    {
        return [
            static::NOT => 'Belum Diperbaiki',
            static::DONE => 'Sudah Diperbaiki'
        ];
    }
}

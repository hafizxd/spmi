<?php

namespace App\Constants;

use App\Constants\BaseConstant;

class UserRole extends BaseConstant
{
    const ADMIN = 1;
    const AUDITOR = 2;
    const UNIT_JURUSAN = 3;
    const UNIT_PRODI = 4;


    public static function labels()
    {
        return [
            static::ADMIN => 'Admin',
            static::AUDITOR => 'Auditor',
            static::UNIT_JURUSAN => 'Unit',
            static::UNIT_PRODI => 'Unit Prodi'
        ];
    }
}

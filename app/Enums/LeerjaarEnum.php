<?php

namespace App\Enums;

enum LeerjaarEnum:int
{
    case KL1 = 1;
    case KL2 = 2;
    case KL3 = 3;
    case LJ1 = 11;
    case LJ2 = 12;
    case LJ3 = 13;
    case LJ4 = 14;
    case LJ5 = 15;
    case LJ6 = 16;
    case MB1 = 21;
    case MB2 = 22;
    case MB3 = 23;
    case MB4 = 24;
    case MB5 = 25;
    case MB6 = 26;

    public function label() {
        return match($this) {
            self::KL1 => '1ste kleuter',
            self::KL2 => '2de kleuter',
            self::KL3 => '3de kleuter',
            self::LJ1 => '1ste leerjaar',
            self::LJ2 => '2de leerjaar',
            self::LJ3 => '3de leerjaar',
            self::LJ4 => '4de leerjaar',
            self::LJ5 => '5de leerjaar',
            self::LJ6 => '6de leerjaar',
            self::MB1 => '1ste middelbaar',
            self::MB2 => '2de middelbaar',
            self::MB3 => '3de middelbaar',
            self::MB4 => '4de middelbaar',
            self::MB5 => '5de middelbaar',
            self::MB6 => '6de middelbaar'

        };
    }
}

<?php

namespace App\Enums;

enum MethodeEnum: string
{
    case BANCONTACT = "bancontact";
    case CASH = "cash";
    case FACTUUR = "factuur";
}

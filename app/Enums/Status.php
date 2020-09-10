<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Status extends Enum
{
    const Request = 1;
    const Borrowed = 2;
    const Returned = 3;
    const Reject = 4;
    const Maximum = 10;
    const Unit = 1;
    const Number = 30;
}

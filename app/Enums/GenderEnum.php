<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GenderEnum extends Enum 
{
    const MALE = 'male';
    const FEMALE = 'female';
    const OTHER = 'other';

}

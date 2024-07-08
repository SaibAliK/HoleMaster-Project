<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ResponseMessagesEnum extends Enum
{

    public const SuccessMessage = 'Successfully performed action';
    public const ErrorMessage = 'Error while performing action';
    public const NoEmailFound = "No user found with this email";



}

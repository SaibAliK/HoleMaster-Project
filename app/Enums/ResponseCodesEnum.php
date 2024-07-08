<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ResponseCodesEnum extends Enum
{
    public const SuccessCode =  200;
    public const Accepted =  202;
    public const ServerCode =  500;
    public const ValidationErrorCode = 401;
    public const UnauthorisedCode = 402;
    public const BadRequest = 400;

    public const VALID_HTTP_ERROR_CODES = [
        400, 401, 402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 412, 413, 414, 415, 416, 417, 418,
        421, 422, 423, 424, 425, 426, 428, 429, 431, 451, 500, 501, 502, 503, 504, 505, 506, 507, 508,
        510, 511
    ];

    public static function httpServeErrorResponseCode(int $code): int
    {
        return in_array($code, self::VALID_HTTP_ERROR_CODES, true) ? $code : 500;
    }
}

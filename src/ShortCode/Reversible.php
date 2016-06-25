<?php
/*
 * This file is part of the ShortCode project.
 *
 * (c) Anis Uddin Ahmad <anis.programmer@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ShortCode;

use ShortCode\Exception\InputIsTooLarge;
use ShortCode\Exception\UnexpectedCodeLength;

/**
 * Random
 *
 * Generate reversible codes from numbers and revert them to original number
 *
 * @author Anis Uddin Ahmad <anis.programmer@gmail.com>
 */
class Reversible extends Code
{

    /**
     * Get a code created from a number
     *
     * @param $input
     * @param string $outputFormat One of Code::FORMAT_* constants. Default Code::FORMAT_ALNUM
     * @param null $minLength
     *
     * @return string
     */
    public static function convert($input, $outputFormat = Code::FORMAT_ALNUM, $minLength = null)
    {
        if(is_int($minLength)) {
            $input += self::getMinForlength($outputFormat, $minLength);
        }

        static::throwUnlessAcceptable($outputFormat, $input);

        return self::convertBase($input, self::FORMAT_NUMBER, $outputFormat);
    }

    /**
     * Revert a code to it's original number
     *
     * @param $input
     * @param string $inputFormat
     * @param null $minLength
     *
     * @return int
     */
    public static function revert($input, $inputFormat = Code::FORMAT_ALNUM, $minLength = null)
    {
        $number = self::convertBase($input, $inputFormat, Code::FORMAT_NUMBER);

        if (is_int($minLength)) {
            $number -= self::getMinForlength($inputFormat, $minLength);
        }

        return $number;
    }

    private static function throwUnlessAcceptable($type, $input)
    {
        if(false != strpos("$input", 'E+')) {
            throw new InputIsTooLarge("Input is too large to process.");
        }

        if($input < 0) {
            throw new UnexpectedCodeLength("Negative numbers are not acceptable for conversion.");
        }
    }

    /**
     * @param $outputFormat
     * @param $minLength
     *
     * @return int|string
     */
    private static function getMinForlength($outputFormat, $minLength)
    {
        $offset         = str_pad($outputFormat[1], $minLength, $outputFormat[0]);
        $offsetAsNumber = \ShortCode\Code::convertBase($offset, $outputFormat, \ShortCode\Code::FORMAT_NUMBER);
        return $offsetAsNumber;
    }

}

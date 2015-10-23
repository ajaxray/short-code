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
     *
     * @return string
     */
    public static function convert($input, $outputFormat = Code::FORMAT_ALNUM)
    {
        static::throwUnlessAcceptable($outputFormat, $input);
        return self::convertBase($input, self::FORMAT_NUMBER, $outputFormat);
    }

    /**
     * Revert a code to it's original number
     *
     * @param $input
     * @param string $inputFormat
     *
     * @return int
     */
    public static function revert($input, $inputFormat = Code::FORMAT_ALNUM)
    {
        return self::convertBase($input, $inputFormat, Code::FORMAT_NUMBER);
    }

    private static function throwUnlessAcceptable($type, $input)
    {
        if($input < 0) {
            throw new UnexpectedCodeLength("Negative numbers are not acceptable for conversion.");
        }
    }

}
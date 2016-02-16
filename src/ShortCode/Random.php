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
 * Generate Random code string of desired length and format
 *
 * @author Anis Uddin Ahmad <anis.programmer@gmail.com>
 */
class Random extends Code
{

    /**
     * Get a random code of fixed length.
     *
     * @param int $length  length of code, default 8
     * @param string $outputFormat One of Code::FORMAT_* constants. Default Code::FORMAT_ALNUM
     *
     * @return string
     */
    public static function get($length = 8, $outputFormat = Code::FORMAT_ALNUM)
    {
        static::throwUnlessAcceptable($outputFormat, $length);

        $number = rand(100, 900) . str_replace('.', '', microtime(true));
        $output = self::convertBase($number, self::FORMAT_NUMBER, $outputFormat);

        if(strlen($output) < $length) {
            $output .= substr(str_shuffle($outputFormat.$outputFormat), 0, ($length - strlen($output)));
        }
        if(strlen($output) > $length) {
            $output = substr($output, 0, $length);
        }

        return $output;
    }

    private static function throwUnlessAcceptable($type, $length)
    {
        if($length > 20) {
            $typeName = self::getTypeName($type);
            throw new UnexpectedCodeLength("Code length $length is not acceptable for $typeName");
        }
    }

}

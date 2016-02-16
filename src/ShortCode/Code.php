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

/**
 * Code
 *
 * Abstract parent for all type of code generation classes.
 *
 * @author Anis Uddin Ahmad <anis.programmer@gmail.com>
 */
abstract class Code
{
    const FORMAT_NUMBER        = '0123456789';
    const FORMAT_ALNUM         = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const FORMAT_ALNUM_SMALL   = '0123456789abcdefghijklmnopqrstuvwxyz';
    const FORMAT_ALNUM_CAPITAL = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const FORMAT_CHAR_SMALL    = 'abcdefghijklmnopqrstwxyz';
    const FORMAT_CHAR_CAPITAL  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * @see http://php.net/manual/en/function.base-convert.php#106546
     *
     * @param $numberInput
     * @param $fromBaseInput
     * @param $toBaseInput
     *
     * @return int|string
     */
    protected static function convertBase($numberInput, $fromBaseInput, $toBaseInput)
    {
        if ($fromBaseInput == $toBaseInput) {
            return $numberInput;
        }

        $fromBase  = str_split($fromBaseInput, 1);
        $toBase    = str_split($toBaseInput, 1);
        $number    = str_split($numberInput, 1);
        $fromLen   = strlen($fromBaseInput);
        $toLen     = strlen($toBaseInput);
        $numberLen = strlen($numberInput);
        $retval    = '';

        if ($toBaseInput == self::FORMAT_NUMBER) {
            $retval = 0;
            for ($i = 1; $i <= $numberLen; $i++) {
                $retval = bcadd($retval, bcmul(array_search($number[$i - 1], $fromBase), bcpow($fromLen, $numberLen - $i)));
            }
            return $retval;
        }
        if ($fromBaseInput != self::FORMAT_NUMBER) {
            $base10 = self::convertBase($numberInput, $fromBaseInput, self::FORMAT_NUMBER);
        } else {
            $base10 = $numberInput;
        }
        if ($base10 < strlen($toBaseInput)) {
            return $toBase[$base10];
        }
        while ($base10 != '0') {
            $retval = $toBase[bcmod($base10, $toLen)] . $retval;
            $base10 = bcdiv($base10, $toLen, 0);
        }

        return $retval;
    }

    protected static function getTypeName($value)
    {
        $class = new \ReflectionClass(__CLASS__);
        $constants = array_flip($class->getConstants());

        return $constants[$value];
    }
}

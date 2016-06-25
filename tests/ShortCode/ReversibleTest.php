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
 * ReversibleTest
 *
 * @author Anis Uddin Ahmad <anis.programmer@gmail.com>
 */
class ReversibleTest extends \PHPUnit_Framework_TestCase
{
    use TestHelper;

    /**
     * @dataProvider formatProvider
     *
     * @param $format
     * @param $formatName
     */
    public function testCodeGeneratedWithCorrectFormat($format, $formatName)
    {
        $code = Reversible::convert(10, $format);
        $length = strlen($code);
        $this->assertSame(1, preg_match("/[$format]{". $length. '}/', $code), 'Trying with '. $formatName);
    }

    /**
     * @dataProvider formatProvider
     *
     * @covers ShortCode\Reversible::convert
     * @covers ShortCode\Reversible::revert
     *
     * @param $format
     * @param $formatName
     */
    public function testRevertGeneratedCode($format, $formatName)
    {
        $sizes = ['xs', 's', 'm', 'l', 'xl', 'xxl'];
        $codes = [];
        $inputs = array_combine($sizes, [6, 87, 389, 4387652, 912791662310, PHP_INT_MAX]);
        // on amd64 linux, PHP_INT_MAX = 9223372036854775807 (2^63-1)

        foreach($sizes as $val) {
            $codes[$val] = Reversible::convert($inputs[$val], $format);
        }

        foreach($sizes as $val) {
            $message = "Trying with {$inputs[$val]} using {$formatName}";
            $this->assertEquals($inputs[$val], Reversible::revert($codes[$val], $format), $message);
        }
    }

    /**
     * @dataProvider formatProvider
     *
     * @covers ShortCode\Reversible::convert
     * @covers ShortCode\Reversible::revert
     *
     * @param $format
     * @param $formatName
     */
    public function testGeneratedCodeWithMinLength($format, $formatName)
    {
        $sizes  = ['xs', 's', 'm', 'l', 'xl'];
        $lengths = [4, 8];
        $codes  = [];
        $inputs = array_combine($sizes, [6, 87, 389, 4387652, 912791662310]);
        // Skipping PHP_INT_MAX as it will throw InputIsTooLarge Exception

        foreach ($sizes as $val) {
            foreach ($lengths as $length) {
                $codes[$length][$val] = Reversible::convert($inputs[$val], $format, $length);
                echo "$length character $formatName for {$inputs[$val]} : {$codes[$length][$val]}" . PHP_EOL;
                $this->assertGreaterThanOrEqual($length, strlen($codes[$length][$val]));
            }
        }

        foreach ($sizes as $val) {
            foreach ($lengths as $length) {
                $message     = "Trying with {$inputs[$val]} using {$formatName} with minimum {$length} char";
                $revertedVal = Reversible::revert($codes[$length][$val], $format, $length);
                $this->assertEquals($inputs[$val], $revertedVal, $message);
            }
        }
    }

    /**
     * @expectedException \ShortCode\Exception\InputIsTooLarge
     */
    public function testExceptionIfInputIsTooLargeToProcess()
    {
        Reversible::convert(PHP_INT_MAX, Code::FORMAT_ALNUM, 8);
    }

    /**
     * @expectedException \ShortCode\Exception\UnexpectedCodeLength
     */
    public function testExceptionIfConvertingNegativeNumber()
    {
        Reversible::convert(-9);
    }
} 
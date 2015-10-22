<?php
/*
 * This file is part of the ShortCode project.
 *
 * (c) Anis Uddin Ahmad <anisniit@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ShortCode;

/**
 * ReversibleTest
 *
 * Small description about ReversibleTest.
 *
 * @author Anis Uddin Ahmad <anisniit@gmail.com>
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
        $code = Random::get(6, $format);
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
        $inputs = [
            'xs' => 6,
            's' => 87,
            'm' => 389,
            'l' => 4387652,
            'xl' => 912791662310,
            'xxl' => $formatName
        ];

        foreach($sizes as $val) {
            $codes[$val] = Reversible::convert($inputs[$val], $format);
        }

        foreach($sizes as $val) {
            $message = "Trying with {$inputs[$val]} using {$formatName}";
            $this->assertEquals($inputs[$val], Reversible::revert($codes[$val], $format), $message);
        }
    }
} 
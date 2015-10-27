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
 * RandomTest
 *
 * @author Anis Uddin Ahmad <anis.programmer@gmail.com>
 */
class RandomTest extends \PHPUnit_Framework_TestCase
{
    use TestHelper;

    public function testRandomCodeGeneration()
    {
        $code = Random::get();
        $matchWith = [];

        for($i = 0; $i < 10; $i++) {
            $matchWith[$i] = Random::get(8, Code::FORMAT_NUMBER);
        }

        $this->assertNotContains($code, $matchWith);
    }


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
     * @param $format
     * @param $formatName
     */
    public function testCodeGeneratedWithCorrectLength($format, $formatName)
    {
        $code4 = Random::get(4, $format);
        $code10 = Random::get(10, $format);
        $code20 = Random::get(20, $format);

        $this->assertSame(4, strlen($code4), "Trying 4 char code with $formatName");
        $this->assertSame(10, strlen($code10), "Trying 10 char code with $formatName");
        $this->assertSame(20, strlen($code20), "Trying 20 char code with $formatName");
    }

    /**
     * @expectedException ShortCode\Exception\UnexpectedCodeLength
     */
    public function testExceptionIfAskedForMoreThen20Chars()
    {
        Random::get(25, Code::FORMAT_NUMBER);
    }
} 
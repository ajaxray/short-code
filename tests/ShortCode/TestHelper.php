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


trait TestHelper 
{
    public function formatProvider()
    {
        return [
            [Code::FORMAT_ALNUM, 'FORMAT_ALNUM'],
            [Code::FORMAT_ALNUM_CAPITAL, 'FORMAT_ALNUM_CAPITAL'],
            [Code::FORMAT_ALNUM_SMALL, 'FORMAT_ALNUM_SMALL'],
            [Code::FORMAT_CHAR_CAPITAL, 'FORMAT_CHAR_CAPITAL'],
            [Code::FORMAT_CHAR_SMALL, 'FORMAT_CHAR_SMALL'],
            [Code::FORMAT_NUMBER, 'FORMAT_NUMBERS'],
        ];
    }
}
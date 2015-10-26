# ShortCode

[![PHP version](https://badge.fury.io/ph/ajaxray%2Fshort-code.svg)](https://badge.fury.io/ph/ajaxray%2Fshort-code)
[![Build Status](https://travis-ci.org/ajaxray/short-code.svg?branch=master)](https://travis-ci.org/ajaxray/short-code)
[![Coverage Status](https://coveralls.io/repos/ajaxray/short-code/badge.svg?branch=feature-badges&service=github)](https://coveralls.io/github/ajaxray/short-code?branch=feature-badges)

ShortCode generator for PHP. Create short, hash like codes. Codes can be random or reversible. Output format is customizable (see the list below).      
You can generate random string code of your desired character length, e.g. 4, 6, 8 ... up to 20.   
Also, you can generate reversible codes from numbers. It's useful when you'll need to trace the original number from a reference code string.    

Can be used for generating small reference codes, tiny URLs or any other purpose.  

## Installation

Install the latest version with

```
$ composer require ajaxray/short-code
```

## Supported Output and Conversion Formats

- `ShortCode\Code::FORMAT_ALNUM` : (Default) Alphanumaric characters. includes 0-9, a-z and A-Z
- `ShortCode\Code::FORMAT_ALNUM_CAPITAL` : Alphanumaric characters. includes 0-9 and A-Z
- `ShortCode\Code::FORMAT_ALNUM_SMALL` : Alphanumaric characters. includes 0-9 and a-z
- `ShortCode\Code::FORMAT_CHAR_CAPITAL` : Capital letter characters. includes only A-Z
- `ShortCode\Code::FORMAT_CHAR_SMALL` : Small letter characters. includes only a-z
- `ShortCode\Code::FORMAT_NUMBER` : Numbers. includes only 0-9. Can be used for random number generation

## Generating Random Code

```php
<?php
ShortCode\Random::get(); 
// Something like (8 chars by default) : aWg2m5Q3

ShortCode\Random::get(6); 
// 6 character length. e.g. r43Nx2

ShortCode\Random::get(8, ShortCode\Code::FORMAT_ALNUM_SMALL); 
// 8 characters with alnum (small letter only). e.g. f43nbg3e2
```

## Generating Reversible Code from numbers
```php
<?php
ShortCode\Reversible::convert(46345223); 
// Output: 38svB

ShortCode\Reversible::revert('38svB');
// Output: 46345223

// If you specify a format for converting, remember to use the same format for reverting
ShortCode\Reversible::convert(46345223, ShortCode\Code::FORMAT_ALNUM_CAPITAL);
// Output: RLC7B

ShortCode\Reversible::revert('RLC7B', ShortCode\Code::FORMAT_ALNUM_CAPITAL);
// Output: 46345223
```

### Workaround for Reversible code with certain length
Let's say, for creating reversible reference code, you are converting the IDs to small letter text.
For id 68, it will become - 
```php
<?php
ShortCode\Reversible::convert(68, ShortCode\Code::FORMAT_CHAR_SMALL);
// Output : cw
```

Now, if the 2 char text don't looks good as a code number and you want a little longer codes,  
just add a fixed salt to increase the numbers. Also, remember to subtract the salt after reverting  

```php
<?php
$salt = 99999;
ShortCode\Reversible::convert(68 + $salt, ShortCode\Code::FORMAT_CHAR_SMALL);
// Output : hfrl
ShortCode\Reversible::revert('hfrl', ShortCode\Code::FORMAT_CHAR_SMALL) - $salt;
// Output : 68
```
  

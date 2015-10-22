# ShortCode

Create short (2 - 20 characters), reversible / random, hash like string

## Installation

Install the latest version with

```
$ composer require ajaxray/ShortCode
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
// Something like: aWg2m5Q3

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

Now, if the 2 char text don't look good as a code number and you want a little longer codes,  
just add a fixed salt to increase the numbers. Also, remember to subtract the salt after reverting  

```php
<?php
$salt = 99999;
ShortCode\Reversible::convert(68 + $salt, ShortCode\Code::FORMAT_CHAR_SMALL);
// Output : hfrl
ShortCode\Reversible::revert('hfrl', ShortCode\Code::FORMAT_CHAR_SMALL) - $salt;
// Output : 68
```
  

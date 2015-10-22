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

ShortCode\Reversible::revert('r43Nx2');
// Output: 46345223

ShortCode\Reversible::convert(46345223, ShortCode\Code::FORMAT_ALNUM_CAPITAL);
// Output: RLC7B

ShortCode\Reversible::revert('RLC7B', ShortCode\Code::FORMAT_ALNUM_CAPITAL);
// Output: 46345223
```

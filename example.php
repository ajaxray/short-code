<?php
include 'vendor/autoload.php';

$br = PHP_EOL;
if(PHP_SAPI != 'cli') {
    echo '<html><body><pre>';
}

$time_start = microtime(true);

echo "{$br}Random code generation $br";
echo "======================================================== $br";

echo "Create some random codes $br";
echo "-------------------------------------------------------- $br";
for($i = 0; $i < 5; $i++) {
    echo "Code $i : ". ShortCode\Random::get(). $br;
}

echo "{$br}Create random codes of 4 characters $br";
echo "-------------------------------------------------------- $br";
for($i = 0; $i < 5; $i++) {
    echo "Code $i : ". ShortCode\Random::get(4). $br;
}

echo "{$br}Create random codes of 6 characters, with small letter only alpha-numaric $br";
echo "-------------------------------------------------------- $br";
for($i = 0; $i < 5; $i++) {
    echo "Code $i : ". ShortCode\Random::get(4, \ShortCode\Code::FORMAT_ALNUM_SMALL). $br;
}

echo "{$br}Create random codes of 10 characters, with capital letter only $br";
echo "-------------------------------------------------------- $br";
for($i = 0; $i < 5; $i++) {
    echo "Code $i : ". ShortCode\Random::get(10, \ShortCode\Code::FORMAT_CHAR_CAPITAL). $br;
}

echo "{$br}Create random codes of 4 characters, numbers only $br";
echo "-------------------------------------------------------- $br";
for($i = 0; $i < 5; $i++) {
    echo "Code $i : ". ShortCode\Random::get(4, \ShortCode\Code::FORMAT_NUMBER). $br;
}

echo "{$br}Reversible code generation and reverting $br";
echo "======================================================== $br";

$number = 54382982;
$alnum = \ShortCode\Reversible::convert($number);
echo "{$br}Converting $number to alphanumeric code : $alnum {$br}";
echo "Reverting $alnum back to number : ". \ShortCode\Reversible::revert($alnum);

$number = 54382982;
$alnumCapital = \ShortCode\Reversible::convert($number, \ShortCode\Code::FORMAT_ALNUM_CAPITAL);
echo "{$br}{$br}Converting $number to (capital letter only) alphanumeric code : $alnumCapital {$br}";
echo "Reverting $alnumCapital back to number : ". \ShortCode\Reversible::revert($alnumCapital, \ShortCode\Code::FORMAT_ALNUM_CAPITAL);

$number = 54382982;
$smallChars = \ShortCode\Reversible::convert($number, \ShortCode\Code::FORMAT_CHAR_SMALL);
echo "{$br}{$br}Converting $number to small letter only code : $smallChars {$br}";
echo "Reverting $smallChars back to number : ". \ShortCode\Reversible::revert($smallChars, \ShortCode\Code::FORMAT_CHAR_SMALL);

echo "{$br}{$br}Reversible code (with minimum x char long) and reverting $br";
echo "======================================================== $br";

$number = 9876;
$alnum = \ShortCode\Reversible::convert($number, \ShortCode\Code::FORMAT_ALNUM, 6);
echo "{$br}Converting $number to  6 CHAR alphanumeric code : $alnum {$br}";
echo "Reverting $alnum back to number : ". \ShortCode\Reversible::revert($alnum,\ShortCode\Code::FORMAT_ALNUM, 6);

$alnumCapital = \ShortCode\Reversible::convert($number, \ShortCode\Code::FORMAT_ALNUM_CAPITAL, 6);
echo "{$br}{$br}Converting $number to minimum 6 character (capital letter only) alphanumeric code : $alnumCapital {$br}";
echo "Reverting $alnumCapital back to number : ". \ShortCode\Reversible::revert($alnumCapital, \ShortCode\Code::FORMAT_ALNUM_CAPITAL, 6);

$smallChars = \ShortCode\Reversible::convert($number, \ShortCode\Code::FORMAT_CHAR_SMALL, 6);
echo "{$br}{$br}Converting $number to minimum 6 character small letter only code : $smallChars {$br}";
echo "Reverting $smallChars back to number : ". \ShortCode\Reversible::revert($smallChars, \ShortCode\Code::FORMAT_CHAR_SMALL, 6);


$time_end = microtime(true);
$time = $time_end - $time_start;

echo "{$br}{$br}Total time taken : $time seconds. $br";


if(PHP_SAPI != 'cli') {
    echo '</pre></body></html>';
}

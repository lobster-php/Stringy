<?php


namespace Bermuda\String;


final class Str
{
    private function __construct()
    {
    }

    private static string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ[~`!@#$%^&*()}{?<>/|_=+-]';

    /**
     * @param string $x
     * @param string $y
     * @param bool $caseInsensitive
     * @return bool
     */
    public static function equals(string $x, string $y, bool $caseInsensitive = true): bool
    {
        return $caseInsensitive ? strcasecmp($x, $y) == 0 : strcmp($x, $y) == 0;
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @param bool $caseInsensitive
     * @param int $offset
     * @return bool
     */
    public static function contains(string $haystack, string $needle, bool $caseInsensitive = true, int $offset = 0): bool
    {
        return $caseInsensitive ? mb_stripos($needle, $haystack, $offset) : mb_strpos($needle, $haystack, $offset);
    }

    /**
     * @param int $num
     * @param string|null $chars
     * @return string
     * @throws \Exception
     */
    public static function random(int $num, ?string $chars = null): string
    {
        $chars = $chars ?? static::$chars;
        $max = strlen($chars) - 1;

        $string = '';

        while ($num--)
        {
            $string .= $chars[random_int(0, $max)];
        }

        return $string;
    }

    /**
     * @param string $string
     * @return string
     * @throws \Exception
     */
    public static function shuffle(string $string): string
    {
        $chars = str_split($string, 1);

        usort($chars, static function (): int
        {
            if(($left = random_int(0, 100)) == ($right = random_int(0, 100)))
            {
                return 0;
            }

            return  $left > $right ? 1 : -1 ;
        });

        return implode('', $chars);
    }

    /**
     * @param string $x
     * @param string[] $any
     * @param bool $caseInsensitive
     * @return bool
     */
    public function equalsAny(string $x, array $any, bool $caseInsensitive = true): bool
    {
        foreach ($any as $string)
        {
            if (static::equals($x, (string) $string, $caseInsensitive))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $input
     * @param int $start
     * @param int $end
     * @return string
     */
    public static function interval(string $input, int $start, int $end): string
    {
        for ($string = ''; $end >= $start ; $start++)
        {
            $string .= $input[$start];
        }

        return $string;
    }
}

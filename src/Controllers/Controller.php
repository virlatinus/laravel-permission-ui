<?php

namespace virlatinus\PermissionsUI\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use virlatinus\PermissionsUI\Helpers\PackageChecker;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function stringToColor(string $str): string
    {
        $minIntensity = 0x33;
        $maxIntensity = 0xAA;

        $hash  = crc32($str);
        $red   = ($hash & 0xFF0000) >> 16;
        $green = ($hash & 0x00FF00) >> 8;
        $blue  = ($hash & 0x0000FF);

        $red -= ($red > $maxIntensity) ? 0xFF - $maxIntensity : 0;
        $green -= ($green > $maxIntensity) ? 0xFF - $maxIntensity : 0;
        $blue -= ($blue > $maxIntensity) ? 0xFF - $maxIntensity : 0;

        $red += ($red < $minIntensity) ? $minIntensity - $red : 0;
        $green += ($green < $minIntensity) ? $minIntensity - $green : 0;
        $blue += ($blue < $minIntensity) ? $minIntensity - $blue : 0;

        $color = ($red << 16) + ($green << 8) + ($blue);

        return "#" . str_pad(dechex($color), 6, "0", STR_PAD_LEFT);
    }

    private static ?bool $hasMultitenancy = null;

    public static function hasMultitenancy(): bool {
        if (is_null(self::$hasMultitenancy)) {
            self::$hasMultitenancy = PackageChecker::isPackageInstalled('spatie/laravel-multitenancy');
        }
        return self::$hasMultitenancy;
    }
}

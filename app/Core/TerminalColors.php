<?php

namespace App\Core;

/**
 * Terminal Colors Enum
 * 
 * Colors you can print on terminal.
 * F[Color] means foreground Color.
 * FLight[Color] means lighter color for foreground.
 * B[Color] means background color.
 */
class TerminalColors
{
    const __default = self::FWhite;

    /**
     * Foreground Colors
     */
    const FWhite = '1;37';
    const FBlack = '0;30';
    const FDarkGray = '1;30';
    const FBlue = '0;34';
    const FLightBlue = '1;34';
    const FGreen = '0;32';
    const FLightGreen = '1;32';
    const FCyan = '0;36';
    const FLightCyan = '1;36';
    const FRed = '0;31';
    const FLightRed = '1;31';
    const FPurple = '0;35';
    const FLightPurple = '1;35';
    const FBrown = '0;33';
    const FYellow = '1;33';
    const FGray = '0;37';

    /**
     * Background Colors
     */
    const BBlack = '40';
    const BRed = '41';
    const BGreen = '42';
    const BYellow = '43';
    const BBlue = '44';
    const BMagenta = '45';
    const BCyan = '46';
    const BGray = '47';
}

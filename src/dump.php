<?php

use Joeyrush\BetterDD\LineInfo;
use Symfony\Component\VarDumper\VarDumper;

if (!function_exists('dl')) {
    /**
     * Light wrapper around dump() which prints out the filepath & line number before the variable(s)
     * @param  $vars
     * @return void
     */
    function dl(...$vars)
    {
        printf(LineInfo::get());
        foreach ($vars as $var) {
            VarDumper::dump($var);
        }
    }
}

function ddl(...$vars)
{

}

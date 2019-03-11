<?php

use JoeyRush\BetterDD\LineInfo;
use Symfony\Component\VarDumper\VarDumper;

if (!function_exists('dumpl')) {
    /**
     * Dump and print line info
     *
     * Light wrapper around dump() which prints out the filepath & line number before the variable(s)
     * @param mixed $vars
     * @return $vars - the variable(s) passed in
     */
    function dumpl(...$vars)
    {
        printf(LineInfo::get());
        foreach ($vars as $var) {
            VarDumper::dump($var);
        }

        return $vars;
    }
}

if (!function_exists('ddl')) {
    /**
     * Dump, die and print line info
     *
     * Same as dl() but kills the script after dumping vars.
     * @param  $vars
     * @return       [description]
     */
    function ddl(...$vars)
    {
        printf(LineInfo::get());
        foreach ($vars as $var) {
            VarDumper::dump($var);
        }

        die;
    }
}

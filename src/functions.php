<?php

use JoeyRush\BetterDD\DumpFactory;
use JoeyRush\BetterDD\LineInfo;

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
        LineInfo::print(LineInfo::get());

        $dumpFactory = new DumpFactory;
        foreach ($vars as $var) {
            $dumpFactory->dump($var);
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
        LineInfo::print(LineInfo::get());

        $dumpFactory = new DumpFactory;
        foreach ($vars as $var) {
            $dumpFactory->dump($var);
        }

        die;
    }
}

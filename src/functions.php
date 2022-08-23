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
        if (request()->expectsJson() && ! app()->runningInConsole()) {
            return dumpJson(...$vars);
        }

        LineInfo::print(LineInfo::pretty());

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
        if (request()->expectsJson() && ! app()->runningInConsole()) {
            return ddJson(...$vars);
        }

        LineInfo::print(LineInfo::pretty());

        $dumpFactory = new DumpFactory;
        foreach ($vars as $var) {
            $dumpFactory->dump($var);
        }

        die;
    }
}

if (!function_exists('ddJson')) {
    /**
     * Dump, die and print line info
     *
     * Same as dl() but kills the script after dumping vars.
     * @param  $vars
     * @return       [description]
     */
    function ddJson(...$vars)
    {
        [$file, $line] = LineInfo::get();

        $print = ['line' => sprintf('%s (line %s)', $file, $line),];
        foreach ($vars as $var) {
            $print[] = $var;
        }
        print_r($print);
        die;
    }
}

if (!function_exists('dumpJson')) {
    /**
     * @param  $vars
     * @return       [description]
     */
    function dumpJson(...$vars)
    {
        [$file, $line] = LineInfo::get();

        $print = ['line' => sprintf('%s (line %s)', $file, $line),];
        foreach ($vars as $var) {
            $print[] = $var;
        }
        print_r($print);
    }
}



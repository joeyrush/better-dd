<?php

/**
 * Light wrapper around dump() which prints out the filepath & line number before the variable(s)
 * @param  $vars
 * @return void
 */
function dumpl(...$vars)
{
    $backtrace = debug_backtrace();
    if ($backtrace instanceof \Exception) {
        $backtrace = $backtrace->getTrace();
    }

    // Strip the noise out of the filepath so we just have a project relative path
    $file = str_replace(dirname(__DIR__), '', $backtrace[0]['file']);
    $lineInfo = sprintf('<div>&nbsp;<strong>%s</strong> (line <strong>%s</strong>)</div>', $file, $backtrace[0]['line']);

    // In CLI, remove HTML and add a new line char.
    if (PHP_SAPI === 'cli' || PHP_SAPI === 'phpdbg') {
        $lineInfo = strip_tags($lineInfo) . "\n";
    }

    printf($lineInfo);
    foreach ($vars as $var) {
        dump($var);
    }
}
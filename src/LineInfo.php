<?php
namespace Joeyrush\BetterDD;

class LineInfo
{
    public static function get()
    {
        $backtrace = debug_backtrace();
        if ($backtrace instanceof \Exception) {
            $backtrace = $backtrace->getTrace();
        }

        // Strip the noise out of the filepath so we just have a project relative path
        $file = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $backtrace[0]['file']);
        $lineInfo = sprintf('<div>&nbsp;<strong>%s</strong> (line <strong>%s</strong>)</div>', $file, $backtrace[0]['line']);

        // In CLI, remove HTML and add a new line char.
        if (PHP_SAPI === 'cli' || PHP_SAPI === 'phpdbg') {
            $lineInfo = strip_tags($lineInfo) . "\n";
        }

        return $lineInfo;
    }
}

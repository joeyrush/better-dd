<?php
namespace JoeyRush\BetterDD;

class LineInfo
{
    /**
     * Gets a pretty filename / line number based on the calling calling code from the stack trace.
     * (two-levels deep because this will be triggered by a helper triggered by your code)
     *
     * @return string
     */
    public static function get()
    {
        $backtrace = debug_backtrace();
        if ($backtrace instanceof \Exception) {
            $backtrace = $backtrace->getTrace();
        }

        // Strip the noise out of the filepath so we just have a project relative path
        $file = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $backtrace[1]['file']);
        $lineInfo = sprintf('<div>&nbsp;<strong>%s</strong> (line <strong>%s</strong>)</div>', $file, $backtrace[1]['line']);

        if (PHP_SAPI === 'cli' || PHP_SAPI === 'phpdbg') {
            // In CLI, remove HTML and add a new line char. Also by putting it in a certain format (path/to/file:line_num)
            // We get the added bonus of being able to Command+Click to open in iTerm (and possibly other shells)
            $lineInfo = sprintf("%s:%s\n", $file, $backtrace[1]['line']);
        } else {
            $lineInfo = sprintf('<div>&nbsp;<strong>%s</strong> (line <strong>%s</strong>)</div>', $file, $backtrace[1]['line']);
        }

        return $lineInfo;
    }
}

<?php
namespace JoeyRush\BetterDD;

use JoeyRush\BetterDD\LineNumberCliDumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;

class LineInfo
{
    /**
     * Gets a pretty filename / line number based on the calling calling code from the stack trace.
     * (two-levels deep because this will be triggered by a helper triggered by your code)
     *
     * @return string
     */
    public static function pretty()
    {
        [$file, $line] = static::get();

        if (PHP_SAPI === 'cli' || PHP_SAPI === 'phpdbg') {
            // In CLI, remove HTML and add a new line char. Also by putting it in a certain format (path/to/file:line_num)
            // We get the added bonus of being able to Command+Click to open in iTerm (and possibly other shells)
            $lineInfo = sprintf("%s:%s", $file, $line);
        } else {
            $lineInfo = sprintf('<div>&nbsp;<strong>%s</strong> (line <strong>%s</strong>)</div>', $file, $line);
        }

        return $lineInfo;
    }

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
        $file = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $backtrace[2]['file']);
        $line = $backtrace[2]['line'];

        return [$file, $line];
    }

    public static function print($lineInfo)
    {
        if (in_array(PHP_SAPI, ['cli', 'phpdbg'])) {
            // This may be total overkill and there's probably a much better way of doing this..
            // The dump() method writes to a stream and uses php://stdout in order to get the fancy colours and styling...
            // But this stream comes **before** any echos/printfs etc. So in order to get the line info to show first in the output
            // I've made a custom dumper, added my own styling, stripped out the wrapping quotes - and this comes before the main dump call.
            $dumper = new LineNumberCliDumper();
            $cloner = new VarCloner;
            $dumper->dump($cloner->cloneVar($lineInfo));
        } else {
            // In the browser we can do a good old echo job
            printf($lineInfo);
        }
    }
}

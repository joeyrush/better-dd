<?php

/**
 * We're using the base_path function from Laravel to strip out the full absolute project path from the line info
 * But we're not pulling in laravel in our test suite so just monkey patch this function
 */
if (!function_exists('base_path')) {
    function base_path()
    {
        return $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__);
    }
}

/**
 * Due to the nature of our dump helpers relying on the order of the stack trace, we have to call the method
 * that fetches the line info from a separate helper function to simulate how it gets called in our dump helpers.
 */
if (!function_exists('call_line_info_get')) {
    function call_line_info_get()
    {
        return JoeyRush\BetterDD\LineInfo::pretty();
    }
}

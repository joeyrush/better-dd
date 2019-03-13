<?php

/**
 * The following configuration values apply to any dumpl($var) / ddl($var) function calls.
 */
return [
    /**
     * Truncate longs strings to a specified number of characters
     * Applies to all strings: i.e. actual strings and strings within variables etc.
     * Use -1 to disable truncation
     */
    'max_string_length' => -1,

    /**
     * Maximum depth of output
     * e.g. 2 will only show arrays within arrays. Anything deeper will get truncated to [...n]
     * where n represents the number of elements cut-off
     */
    'max_depth' => 20,
    'max_items_per_depth' => -1
];

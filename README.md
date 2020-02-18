# Better DD For Laravel
😅 Replace your `dump` / `dd` calls with `dumpl` / `ddl` to get the filepath and line number included. A simple but **much needed** feature! Works in both the browser and terminal.

> Bonus: You can use the semantic history feature of iTerm to Command+Click the line number output in the terminal (You can customize which editor is chosen to open files via iTerm->Preferences->Profiles->Advanced->Semantic History)

![](https://i.imgur.com/w35SliI.gif)

## Requirements
- Any version of laravel

## Getting Started

You can install the package via composer:
```
composer require joeyrush/better-dd
```

...and that's all!

## Usage

Exactly the same as `dd`:
```php
dumpl($var1, $var2, $var3...);
ddl($var1, $var2, $var3...);
```

## Configuration: Output Truncation

When using the dump helpers inside the terminal, often output can be difficult to read due to the size. Sometimes you surpass your terminals buffer length and lose some data. For that reason, we've provided some truncation options via a config.

> Disclaimer: This feature only applies to terminal output because there is very little point in truncating output in the browser because they can be collapsed interactively.

First publish the config with artisan:

```bash
php artisan vendor:publish --provider=JoeyRush\\BetterDD\\BetterDDServiceProvider
```

The following configuration are now available to customize to your needs (see `config/better-dd.php` after running the publish command)

```php
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
```

## Tests
After a composer install, run `composer test`

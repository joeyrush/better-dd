# Better DD For Laravel
😅 Replace your `dump` / `dd` calls with `dumpl` / `ddl` to get the filepath and line number included. A simple but **much needed** feature! Works in both the browser and terminal.

> Bonus: You can use the semantic history feature of iterm to Command+Click the line number output in the terminal (If this doesn't work in your version of iTerm, refer to Preferences->Profiles->Advanced->Semantic History)

![](https://i.imgur.com/w35SliI.gif)

## Requirements
- Laravel (any 4.* / 5.* version)

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

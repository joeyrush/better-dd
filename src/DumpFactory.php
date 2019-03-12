<?php
namespace JoeyRush\BetterDD;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

class DumpFactory
{
    public function __construct($settings = [])
    {
        // TODO: setup a config for these. Until then, they aren't actually being used.
        $defaults = [
            'max_string_length' => 20,
            'max_depth' => 3,
            'max_items_per_depth' => 20
        ];

        $this->dumper = in_array(PHP_SAPI, ['cli', 'phpdbg']) ? new CliDumper() : new HtmlDumper();
        $this->cloner = new VarCloner();
        $this->settings = array_merge([
            'max_string_length' => -1,
            'max_depth' => 20,
            'max_items_per_depth' => -1
        ], $settings);
    }

    public function dump($var)
    {
        // truncate long strings
        $this->cloner->setMaxString($this->settings['max_string_length']);

        $clonedVar = $this->cloner->cloneVar($var)
            ->withMaxDepth($this->settings['max_depth'])
            ->withMaxItemsPerDepth($this->settings['max_items_per_depth']);

        $dump = $this->dumper->dump($clonedVar);
    }
}

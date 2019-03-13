<?php
namespace JoeyRush\BetterDD;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

class DumpFactory
{
    public function __construct($settings = [])
    {
        $this->cli = in_array(PHP_SAPI, ['cli', 'phpdbg']);
        $this->dumper = $this->cli ? new CliDumper() : new HtmlDumper();
        $this->cloner = new VarCloner();
        $this->settings = $settings ?: config('better-dd');
    }

    public function dump($var)
    {
        if ($this->cli) {
            $this->cloner->setMaxString($this->settings['max_string_length']);
        }

        $clonedVar = $this->cloner->cloneVar($var);

        if ($this->cli) {
            $clonedVar = $clonedVar->withMaxDepth($this->settings['max_depth'])
                ->withMaxItemsPerDepth($this->settings['max_items_per_depth']);
        }

        return $this->dumper->dump($clonedVar);
    }
}

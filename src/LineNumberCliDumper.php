<?php
namespace JoeyRush\BetterDD;

use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\VarDumper\Dumper\CliDumper;

class LineNumberCliDumper extends CliDumper
{
    public function dump(Data $data, $output = null): ?string
    {
        $this->setStyles(['str' => '1;38;5;97']);
        return parent::dump($data, $output);
    }

    protected function echoLine($line, $depth, $indentPad)
    {
        // Remove the wrapping quotes which get set somewhere in the base dumper
        $line = str_replace('"', '', $line);

        // Add a new line before the outputted line so it doesn't end up merged in with the PHPUnit output
        $line = "\n" . $line;

        return parent::echoLine($line, $depth, $indentPad);
    }
}

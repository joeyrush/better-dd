<?php
namespace JoeyRush\BetterDD\Tests;

use JoeyRush\BetterDD\LineInfo;

class LineInfoTest extends TestCase
{
    /** @test */
    public function includes_relative_path_to_file_where_function_is_called_from()
    {
        $lineInfo = call_line_info_get();

        $this->assertContains('tests/LineInfoTest.php', $lineInfo);
    }

    /** @test */
    public function includes_correct_line_number_from_where_the_function_gets_called()
    {
        $lineInfo = call_line_info_get();

        // A bit brittle to rely on a line number, but this test class should have no reason to change
        // Therefore the line number shouldn't change
        $correctLineNumber = 19;

        $this->assertContains((string)$correctLineNumber, $lineInfo);
    }
}

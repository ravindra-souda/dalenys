<?php


use PHPUnit\Framework\TestCase;

class SnailTest extends TestCase
{
    /**
     * @dataProvider getValidBoxes
     * @param $width
     * @param $expected
     */
    public function testValidBoxes($width, $expected)
    {
        $snail = new \Snail($width);

        $this->assertEquals($expected, $snail->getBox());
    }

    /**
     * Data provider for {@link SnailTest::testValidBoxes()}
     * @return array
     */
    public function getValidBoxes()
    {
        return [
            [1, [[1]] ],
            [2, [
                [1, 2],
                [4, 3]
            ]],
            [3, [
                [1, 2, 3],
                [8, 9, 4],
                [7, 6, 5]
            ]],
            [4, [
                [1, 2, 3, 4],
                [12, 13, 14, 5],
                [11, 16, 15, 6],
                [10, 9, 8, 7]
            ]]
        ];
    }
}

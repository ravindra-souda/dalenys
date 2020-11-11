<?php


class Snail
{
    /**
     * @var array
     */
    private $box = array();

    /**
     * @var array
     */
    private const DIRECTIONS = ['right', 'down', 'left', 'top'];

    /**
     * @var int
     */
    private $x = -1;

    /**
     * @var int
     */
    private $y = 0;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $count = 1;

    public function __construct(int $width)
    {
        $this->width = $width;
        for ($i = 0; $i < $width; $i++) {
            $subArray = array_fill(0, $width, 0);
            array_push($this->box, $subArray);
        }

        $dir = 0;
        while ($this->count < ($width * $width + 1)) {
            if (!$this->buildBox($dir)) {
                $dir++;
                if ($dir > 3) {
                    $dir = 0;
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getBox(): array
    {
        return $this->box;
    }

    /**
     * @param int $dir
     * @return bool
     */
    private function buildBox(int $dir): bool
    {
        switch (self::DIRECTIONS[$dir]) {
            case 'right':
                if ($this->x + 1 === $this->width || !$this->cellIsEmpty($this->y, $this->x + 1)) {
                    return false;
                } else {
                    $this->x++;
                    break;
                }
            case 'down':
                if ($this->y + 1 === $this->width || !$this->cellIsEmpty($this->y + 1, $this->x)) {
                    return false;
                } else {
                    $this->y++;
                    break;
                }
            case 'left':
                if ($this->x - 1 === -1 || !$this->cellIsEmpty($this->y, $this->x - 1)) {
                    return false;
                } else {
                    $this->x--;
                    break;
                }
            case 'top':
                if ($this->y - 1 === -1 || !$this->cellIsEmpty($this->y - 1, $this->x)) {
                    return false;
                } else {
                    $this->y--;
                    break;
                }
        }

        $this->box[$this->y][$this->x] = $this->count;
        $this->count++;

        return true;
    }

    /**
     * Helper for buildBox
     * @param int $y
     * @param int $x
     * @return bool
     */
    private function cellIsEmpty(int $y, int $x): bool
    {
        return $this->box[$y][$x] === 0;
    }

    /**
     * Entry point of application
     * Outputs data in snail.html
     */
    public function draw(): void 
    {
        $html = '<html><head></head><body><table>';
        foreach ($this->box as $row) {
            $html .= '<tr>';
            foreach ($row as $cell) {
                $html .= '<td>'.$cell.'</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table></body></html>';

        echo file_put_contents('snail.html', $html) ?
            'snail.html successfully generated'.PHP_EOL : 'snail.html generation failed'.PHP_EOL;
    }
}

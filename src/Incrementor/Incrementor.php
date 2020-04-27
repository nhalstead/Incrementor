<?php

namespace nhalstead\Incrementor;

use JsonSerializable;
use Tightenco\Collect\Support\Collection;

/**
 * Incrementor
 * Using an Expression, generate a list of the formatted
 *  items with the given format.
 *
 * @author Noah Halstead <nhalstead00@gmail.com>
 */
class Incrementor implements JsonSerializable
{

    /**
     * Automatically Create a new instance and
     *  return the Collection of the results.
     *
     * @param string $expression
     * @param int $max
     * @return Collection
     */
    public static function get(string $expression, int $max = null)
    {
        $inst = new self($expression, $max);
        return $inst->toCollection();
    }

    /**
     *
     * @param string $expression
     * @return bool
     */
    public static function hasExpression(string $expression)
    {

        $parts = self::getExpressionParts($expression);
        if ($parts->incrementor !== "") {
            return true;
        }
        return false;
    }

    /**
     *
     * @param string $expression
     * @return Expression
     */
    public static function getExpressionParts(string $expression)
    {

        // What can be before and after the Number Expression
        $allowedChars = "a-zA-Z0-9\s\_\-\(\)\{\}\~\:\>\<\/\\\\\|\]\[";

        $re = '/([' . $allowedChars . ']*)\{(([0-9]*)\^([0-9]*))\}([' . $allowedChars . ']*)/m';
        preg_match_all($re, $expression, $matches, PREG_SET_ORDER, 0);

        $return = new Expression();
        $return->expression = $expression;

        if(count($matches) !== 0)
        {
            $return->prefix = $matches[0][1];
            $return->incrementor = $matches[0][2]; // The Number Generating Parts
            $return->start = intval($matches[0][3]);
            $return->length = strlen($matches[0][3]);
            $return->suffix = $matches[0][5];
        }

        return $return;
    }

    /**
     * Text to put After the Number
     *
     * @var string
     */
    protected $suffix = "";

    /**
     * Text to put Before the Number
     *
     * @var string
     */
    protected $prefix = "";

    /**
     * The Input Template
     *
     * @var string
     */
    protected $expression = "";

    /**
     * Starting Number from the Expression
     *
     * @var int
     */
    protected $startingInt = 0;

    /**
     * Max Numbers to Generate
     *
     * @var int
     */
    protected $totalInt = 0;

    /**
     * Length of the Number to output
     * If the length is not meant, add leading zeros.
     *
     * @var int
     */
    protected $length = 0;

    /**
     * Array of the Generated Elements
     *
     * @var Collection
     */
    protected $results;

    /**
     *
     * @param string $expression
     * @param int $max
     */
    public function __construct(string $expression, int $max = null)
    {
        $parts = self::getExpressionParts($expression);

        $this->totalInt = abs($max ?? 1);

        $this->suffix = $parts->suffix;
        $this->prefix = $parts->prefix;
        $this->expression = $parts->expression;
        $this->length = $parts->length;
        $this->startingInt = $parts->start;

        $this->generate();
    }

    /**
     *  Generates the Output using the format given.
     *
     */
    private function generate()
    {
        $this->results = new Collection();
        $iterationStep = 0;

        // Do the Generation Task
        while ($iterationStep < $this->totalInt) {
            $this->results->push($this->prefix
                . $this->getNumber($iterationStep)
                . $this->suffix);

            $iterationStep++;
        }
    }

    /**
     *
     * @param int $iterationStep
     * @return string
     */
    public function getNumber(int $iterationStep)
    {
        $number = (string)($this->startingInt + $iterationStep);
        $cLength = strlen($number);

        if ($cLength < $this->length) {
            // The min length is larger.
            $diff = $this->length - $cLength;
            $leadingZero = str_repeat("0", $diff);

            $number = $leadingZero . $number;
        }

        return $number;
    }

    /**
     * Return the Collection
     *
     * @return Collection
     */
    public function toCollection()
    {
        return $this->results;
    }

    public function jsonSerialize()
    {
        return $this->results->toArray();
    }

}


?>

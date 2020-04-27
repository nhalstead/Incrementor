<?php

namespace nhalstead\Incrementor;

class Expression {

    /**
     * The format of the expression that is used to generate the output
     *
     * @var string
     */
    public $expression = "";

    /**
     * The beginning string of the expression.
     *
     * @var string
     */
    public $prefix = "";

    /**
     * The incrementer is the control string that determines the start index
     *  and the format.
     *
     * @var string
     */
    public $incrementor = "";

    /**
     * Starting index
     *
     * @var int
     */
    public $start = 0;

    /**
     * The min number length for the number.
     *
     * @var int
     */
    public $length = 0;

    /**
     * The ending of the return string.
     *
     * @var string
     */
    public $suffix = 0;

}
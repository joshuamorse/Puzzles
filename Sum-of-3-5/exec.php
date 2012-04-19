<?php

namespace Puzzle\SumOf35;

require_once(__DIR__ . '/Solution.php');

use Puzzle\SumOf35\Solution;

$threshold = 1000;
$multiples = array(3,5);

$solution = new Solution($threshold, $multiples);
$solution->setNaturalNumbers();

echo sprintf('The answer is: %d', $solution->getSum());
echo "\n";

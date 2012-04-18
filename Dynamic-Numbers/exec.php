<?php

/**
 * This is a procedural solution for finding 99% proportion.  
 * It makes use of a number object to determine if numbers are dynamic.
 */

namespace Puzzle\DynamicNumbers;

require_once(__DIR__ . '/Number.php');

use Puzzle\DynamicNumbers\Number;

/**
 * Since we know that 101 is the smallest dynamic number,
 * we'll start with a combination of number/dynamic numbers of which we certain. 
 */
$dynamicNumbers = 0;
$number = 100;

/** Represents if/when our desired proportion is found. */
$found = false;

/** Represents our desired proportion. */
$proportionToFind = 99.00;

/** We'll keep iterating until we find our proportion. */
while (true) {
    $numberObject = new Number((int) $number);

    if ($numberObject->isDynamic()) {
        ++$dynamicNumbers;
    }

    $proportion = $numberObject->getProportion($dynamicNumbers);

    $message = sprintf('%d (%s) has a proportion of %s%s (%d dynamic numbers). %s',
        $number,
        $numberObject->isDynamic() ? 'is dynamic' : 'is not dynamic',
        $proportion,
        '%',
        $dynamicNumbers,
        "\n"
    );

    if ($proportion === $proportionToFind) {
        $found = true;
        $message = sprintf('%d has a proportion of %s%s. Victory!%s',
            $number,
            $proportionToFind,
            '%',
            "\n"
        );
    }

    echo $message;

    if ($found) {
        die;
    }

    ++$number;
}

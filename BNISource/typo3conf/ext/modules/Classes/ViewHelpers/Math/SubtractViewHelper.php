<?php

namespace CodingMs\Modules\ViewHelpers\Math;

/*
 * This file is part of the FluidTYPO3/Vhs project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

/**
 * Math: Subtract
 *
 * Performs subtraction of $a and $b. A can be an array and $b a
 * number, in which case each member of $a gets subtracted $b.
 * If $a is an array and $b is not provided then neg. array_sum is
 * used to return a single numeric value. If both $a and $b are
 * arrays, each member of $a is summed against the corresponding
 * member in $b compared using index.
 *
 * @author Claus Due <claus@namelesscoder.net>
 */
class SubtractViewHelper extends AbstractMultipleMathViewHelper
{
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->overrideArgument('b', 'mixed', 'Optional: Second number or Iterator/Traversable/Array for calculation', false, null);
    }

    /**
     * @return mixed
     * @throw Exception
     */
    public function render()
    {
        $a = $this->getInlineArgument();
        $b = $this->arguments['b'];
        $aIsIterable = $this->assertIsArrayOrIterator($a);
        if (true === $aIsIterable && null === $b) {
            $a = $this->arrayFromArrayOrTraversableOrCSV($a);
            return -array_sum($a);
        }
        return $this->calculate($a, $b);
    }

    /**
     * @param mixed $a
     * @param $b
     * @return mixed
     */
    protected function calculateAction($a, $b)
    {
        return $a - $b;
    }
}

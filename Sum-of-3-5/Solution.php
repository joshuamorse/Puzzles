<?php

namespace Puzzle\SumOf35;

class Solution
{
	protected
		/** Represents the natural numbers found within our threshold. */
		$naturalNumbers = array(),

		/** Represents the multiples we'll check against. */
		$multiples,

		/** Represents the number for which we'll be finding natural numbers. */
		$threshold
	;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($threshold, array $multiples)
	{
		$this->multiples = $multiples;
		$this->threshold = $threshold;
	}

	/**
	 * setNaturalNumbers 
	 * 
	 * @access public
	 * @return void
	 */
	public function setNaturalNumbers()
	{
		for ($i = 1; $i < $this->threshold; ++$i) {
			if ($this->isMultipleOfMultiples($i)) {
				array_push($this->naturalNumbers, $i);
			}
		}
	}

	/**
	 * Determines if the supplied number is a multiple of any of the set multiples.
	 * 
	 * @param mixed $number 
	 * @access protected
	 * @return boolean $isMultiple
	 */
	protected function isMultipleOfMultiples($number)
	{
		$isMultiple = false;

		foreach ($this->multiples as $multiple) {
			if ($this->isMultipleOfSingle($multiple, $number)) {
				$isMultiple = true;
				break;
			}
		}

		return $isMultiple;
	}

	/**
	 * Determines if a number is divisible by a multiple. 
	 * 
	 * @param mixed $multiple 
	 * @param mixed $number 
	 * @return boolean
	 */
	public function isMultipleOfSingle($multiple, $number)
	{
		$isMultiple = (0 === ($number % $multiple));

		return $isMultiple;
	}

	/**
	 * Returns ``$this->naturalNumbers``.
	 * 
	 * @access public
	 * @return void
	 */
	public function getNaturalNumbers()
	{
		return $this->naturalNumbers;
	}

	/**
	 * Calculates the sum of ``$this->naturalNumbers``.
	 * 
	 * @access public
	 * @return integer $sum
	 */
	public function getSum()
	{
		$sum = 0;

		foreach ($this->naturalNumbers as $number) {
			$sum += $number;
		}

		return $sum;
	}
}

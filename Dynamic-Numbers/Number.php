<?php

/**
 * A number object which represents a number.
 * Its purpose is to determine if a number is dynamic alonside calculating proportion.
 * 
 * @package 
 * @version $id$
 * @author Joshua Morse <dashvibe@gmail.com> 
 */

namespace Puzzle\DynamicNumbers;

class Number
{
	/** Represents the various possible number types. */
	const TYPE_ASC  = 'ascending';
	const TYPE_DESC = 'descending';
	const TYPE_BOTH = 'both';
	const TYPE_DYN  = 'dynamic';

	protected
		/** Set the length of the string over which we'll iterate. */
		$length,

		/** Represents the number which this object represents. */
		$number,

		/** Represents the type of the current number. */
		$type,

		/** Represents the found types within the current number. */
		$typeCounter
	;

	/**
	 * Construct takes an integer as an argument.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($number)
	{
		$this->setTypeCounter();
		$this->setNumber($number);
	}

	/**
	 * Parses this number's type. 
	 * 
	 * @access public
	 * @return void
	 */
	public function parseType()
	{
		$this->setLength();

		for ($i = 0; $i < $this->length; ++$i) {
			/** Set the length of the string over which we'll iterate. */
			$numString = (string) $this->number;

			/** Set the current number. */
			$currentNum = $numString[$i];

			/** Set the previous number, should it exist. */
			$previousNumber = isset($numString[($i - 1)]) ? $numString[($i - 1)] : null;

			if (null !== $previousNumber) {
				$this->updateTypeCounter((int) $currentNum, (int) $previousNumber);
			}
		}

		$this->type = $this->getNumberType();
	}

	/**
	 * Parses this number's proportion of lesser dynamic numbers.
	 * Accepts an argument representing the amount of dynamic numbers leading up to
	 * (and including) the current number.
	 * 
	 * @access public
	 * @return float $proportion
	 */
	public function getProportion($dynamicNumbers)
	{
		/** Ensure we're not dividing by 0. */
		if ($dynamicNumbers < 1) {
			$proportion = 0;
		} else {
			$proportion = (($dynamicNumbers / $this->number) * 100);
		}

		return (float) $proportion;
	}

	/**
	 * Returns whether or not this number is dynamic.
	 * 
	 * @access public
	 * @return boolean
	 */
	public function isDynamic()
	{
		/** Usage of a singleton-esque pattern here will ensure we're not running
		 * ``parseType()`` twice for a given number.
		 */
		if (null === $this->type) {
			$this->parseType();
		}

		$isDynamic = ('dynamic' === $this->type);

		return $isDynamic;
	}

	/**
	 * Sets a number based on integer type. 
	 * 
	 * @param mixed $number 
	 * @access public
	 * @return void
	 */
	public function setNumber($number)
	{
		if (!is_integer($number)) {
			throw new Exception('Cannot instantiate a Number object without a supplied integer!');
		}

		$this->number = $number;
	}

	/**
	 * Sets the length of the current number casted to a string. 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function setLength()
	{
		$this->length = strlen((string) $this->number);
	}

	/**
	 * Inits ``$typeCounter``.
	 * 
	 * @access protected
	 * @return void
	 */
	protected function setTypeCounter()
	{
		$this->typeCounter = array(
			self::TYPE_ASC  => null,
			self::TYPE_BOTH => null,
			self::TYPE_DESC => null,
			self::TYPE_DYN  => null,
		);
	}

	/**
	 * Updates ``$typeCounter`` with the current number type.
	 * Type is determined via ``$currentNum`` and ``$previousNum``.
	 * 
	 * @param mixed $currentNum 
	 * @param mixed $previousNumber 
	 * @access protected
	 * @return string $type
	 */
	protected function updateTypeCounter($currentNum, $previousNumber) {
		$isAscending  = ($currentNum > $previousNumber);
		$isDescending = ($currentNum < $previousNumber);
		$isEqual      = ($currentNum === $previousNumber);

		if ($isAscending) {
			$type = self::TYPE_ASC;
		} else if ($isDescending) {
			$type = self::TYPE_DESC;
		} else if ($isEqual) {
			$type = self::TYPE_BOTH;
		} else {
			$type = self::TYPE_DYN;
		}

		$this->typeCounter[$type] = true;

		return $type;
	}

	/**
	 * Determines this number's type based on data/results in ``$typeCounter``.
	 * In other words, it "makes sense" of the data within ``$typeCounter``.
	 * 
	 * @param mixed $types 
	 * @access public
	 * @return string
	 */
	public function getNumberType() {
		if ($this->typeCounter[self::TYPE_ASC] && $this->typeCounter[self::TYPE_DESC]) {
			return self::TYPE_DYN;
		} else if ($this->typeCounter[self::TYPE_ASC]) {
			return self::TYPE_ASC;
		} else if ($this->typeCounter[self::TYPE_DESC]) {
			return self::TYPE_DESC;
		} else if ($this->typeCounter[self::TYPE_BOTH]) {
			return self::TYPE_BOTH;
		}
	}
}

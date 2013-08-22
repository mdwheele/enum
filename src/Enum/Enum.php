<?php namespace Enum;


abstract class Enum
{
    /**
     * The current selected value.
     * @var mixed
     */
    protected $value = null;

    /**
     * An array of constants defined on child class.
     * @var array
     */
    protected $constants = null;

    final public function __construct($value = null)
    {

        $reflectionClass = new \ReflectionClass($this);
        $this->constants = $reflectionClass->getConstants();

        if(!is_null($value)){
            $this->value = $value;
        }

        if(!in_array($this->value, $this->constants, true)){
            throw new \InvalidArgumentException("No value set and no default defined.");
        }
    }

    final public function getConstants()
    {
        return $this->constants;
    }

    final public function setValue($value)
    {
        if(!in_array($value, $this->constants, true)){
            throw new \InvalidArgumentException("Not a valid enumeration value for this enum type.");
        }

        $this->value = $value;
    }

    final public function getValue()
    {
        return $this->value;
    }
}
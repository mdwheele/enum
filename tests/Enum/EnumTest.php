<?php

use Enum\Enum;

class MockEnum extends Enum
{
    const One = 1;
    const Two = 2;
    const Three = 3;
}

class MockEnumDefault extends Enum
{
    const One = 1;
    const Two = 2;
    const Three = 3;

    protected $value = MockEnumDefault::One;
}

class EnumTest extends PHPUnit_Framework_TestCase
{
    public function testEnumDefault()
    {
        $enum = new MockEnumDefault();

        $this->assertEquals(MockEnumDefault::One, $enum->getValue());
    }

    public function testDefaultValueThroughConstructor()
    {
        $enum = new MockEnum(MockEnum::Two);

        $this->assertEquals(MockEnum::Two, $enum->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEmptyConstructorWithNoDefault(){
        $enum = new MockEnum();
        $this->fail("Should throw InvalidArgumentException");
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testValueOutsideEnumRange()
    {
        $num = new MockEnum("turkey");
        $this->fail("Should throw InvalidArgumentException");
    }

    public function testGetConstants()
    {
        $enum = new MockEnum(MockEnum::One);

        $constants = $enum->getConstants();

        $this->assertCount(3, $constants);
        $this->assertEquals(MockEnum::One, $constants['One']);
        $this->assertEquals(MockEnum::Two, $constants['Two']);
        $this->assertEquals(MockEnum::Three, $constants['Three']);
    }

    public function testSetValue()
    {
        $enum = new MockEnum(MockEnum::One);

        $this->assertEquals(MockEnum::One, $enum->getValue());

        $enum->setValue(MockEnum::Two);

        $this->assertEquals(MockEnum::Two, $enum->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetValueOutsideRange()
    {
        $enum = new MockEnum(MockEnum::One);

        $enum->setValue("blah");
        $this->fail("Should throw InvalidArgumentException");
    }
}
<?php

namespace Dhii\Data\UnitTest;

use Dhii\Data\AbstractBaseStateAware as TestSubject;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Xpmock\TestCase;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class AbstractBaseStateAwareTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Data\AbstractBaseStateAware';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @param array $methods The methods to mock.
     *
     * @return TestSubject|MockObject
     */
    public function createInstance(array $methods = [])
    {
        return $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
                    ->setMethods(array_merge([], $methods))
                    ->getMockForAbstractClass();
    }

    public function createMap()
    {
        return $this->mock('Dhii\Collection\MapInterface')
                    ->get()
                    ->has()
                    ->new();
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInstanceOf(
            static::TEST_SUBJECT_CLASSNAME,
            $subject,
            'A valid instance of the test subject could not be created.'
        );

        $this->assertInstanceOf(
            'Dhii\Data\StateAwareInterface',
            $subject,
            'Test subject does not implement expected interface.'
        );
    }

    /**
     * Tests the constructor to assert whether the setter method is called.
     *
     * @since [*next-version*]
     */
    public function testConstructor()
    {
        $subject = $this->createInstance(['_setState']);
        $reflect = $this->reflect($subject);

        $stateMap = $this->createMap();

        $subject->expects($this->once())
                ->method('_setState')
                ->with($stateMap);

        $reflect->_init($stateMap);
    }

    /**
     * Tests the getter method to assert whether the returned state map is the same as the one used in construction.
     *
     * @since [*next-version*]
     */
    public function testGetState()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $stateMap = $this->createMap();

        $reflect->_init($stateMap);

        $this->assertSame($stateMap, $reflect->getState(), 'Set and retrieved state maps are not the same');
    }
}

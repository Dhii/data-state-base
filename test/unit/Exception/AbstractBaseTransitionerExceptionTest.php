<?php

namespace Dhii\Data\Exception\UnitTest;

use Dhii\Data\Exception\AbstractBaseTransitionerException;
use Dhii\Data\TransitionerInterface;
use Exception;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use stdClass;
use Xpmock\TestCase;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class AbstractBaseTransitionerExceptionTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Data\Exception\AbstractBaseTransitionerException';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return MockObject|AbstractBaseTransitionerException
     */
    public function createInstance()
    {
        $mock = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
                     ->getMockForAbstractClass();

        return $mock;
    }

    /**
     * Creates a mock transitioner instance.
     *
     * @since [*next-version*]
     *
     * @return TransitionerInterface
     */
    public function createTransitioner()
    {
        $mock = $this->mock('Dhii\Data\TransitionerInterface')
                     ->transition();

        return $mock->new();
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
            'Dhii\Data\Exception\TransitionerExceptionInterface',
            $subject,
            'Test subject does not implement expected interface.'
        );

        $this->assertInstanceOf(
            'Exception',
            $subject,
            'Test subject is not an exception.'
        );
    }

    /**
     * Tests the initializer method to ensure that all data is correct set.
     *
     * @since [*next-version*]
     */
    public function testInit()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $message      = uniqid('message-');
        $code         = rand();
        $previous     = new Exception();
        $transitioner = $this->createTransitioner();

        $reflect->_init($message, $code, $previous, $transitioner);

        $this->assertEquals(
            $message,
            $subject->getMessage(),
            'Set and retrieved messages are not the same.'
        );
        $this->assertEquals(
            $code,
            $subject->getCode(),
            'Set and retrieved codes are not the same.'
        );
        $this->assertSame(
            $previous,
            $subject->getPrevious(),
            'Set and retrieved inner exceptions are not the same.'
        );
        $this->assertSame(
            $transitioner,
            $subject->getTransitioner(),
            'Set and retrieved transitioners are not the same.'
        );
    }

    /**
     * Tests the initializer method with an invalid transitioner to assert whether an exception is thrown.
     *
     * @since [*next-version*]
     */
    public function testInitInvalidTransitioner()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $message      = uniqid('message-');
        $code         = rand();
        $previous     = new Exception();
        $transitioner = new stdClass();

        $this->setExpectedException('InvalidArgumentException');

        $reflect->_init($message, $code, $previous, $transitioner);
    }
}

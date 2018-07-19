<?php

namespace Dhii\Data\FuncTest;

use Dhii\Data\StateAwareInterface;
use Dhii\Data\TransitionerInterface;
use Exception;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Xpmock\TestCase;

/**
 * Tests {@see \Dhii\Data\CreateCouldNotTransitionExceptionCapableTrait}.
 *
 * @since [*next-version*]
 */
class CreateCouldNotTransitionExceptionCapableTraitTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Data\CreateCouldNotTransitionExceptionCapableTrait';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return MockObject
     */
    public function createInstance()
    {
        $builder = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
                        ->setMethods([]);

        $mock = $builder->getMockForTrait();

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
     * Creates a mock instance of a state-aware object.
     *
     * @since [*next-version*]
     *
     * @return StateAwareInterface
     */
    public function createStateAware()
    {
        $mock = $this->mock('Dhii\Data\StateAwareInterface')
                     ->getState();

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

        $this->assertInternalType(
            'object',
            $subject,
            'An instance of the test subject could not be created'
        );
    }

    /**
     * Tests the exception creation method to assert whether the created instance is a valid exception and that all
     * relevant data can be correctly retrieved from it.
     *
     * @since [*next-version*]
     */
    public function testCreateTransitionerException()
    {
        $subject = $this->createInstance();
        $reflect = $this->reflect($subject);

        $message      = uniqid('message-');
        $code         = rand();
        $previous     = new Exception();
        $transitioner = $this->createTransitioner();
        $stateAware   = $this->createStateAware();
        $transition   = uniqid('transition-');

        $instance = $reflect->_createCouldNotTransitionException(
            $message,
            $code,
            $previous,
            $transitioner,
            $stateAware,
            $transition
        );

        $this->assertInstanceOf(
            'Dhii\Data\Exception\CouldNotTransitionExceptionInterface',
            $instance,
            'Created exception does not implement expected interface.'
        );

        $this->assertInstanceOf(
            'Exception',
            $instance,
            'Created instance is not an exception.'
        );

        $this->assertEquals(
            $message,
            $instance->getMessage(),
            'Set and retrieved messages are not the same.'
        );
        $this->assertEquals(
            $code,
            $instance->getCode(),
            'Set and retrieved codes are not the same.'
        );
        $this->assertSame(
            $previous,
            $instance->getPrevious(),
            'Set and retrieved inner exceptions are not the same.'
        );
        $this->assertSame(
            $transitioner,
            $instance->getTransitioner(),
            'Set and retrieved transitioners are not the same.'
        );
        $this->assertEquals(
            $transition,
            $instance->getTransition(),
            'Set and retrieved transitions are not the same.'
        );
        $this->assertSame(
            $stateAware,
            $instance->getSubject(),
            'Set and retrieved subject are not the same.'
        );
    }
}

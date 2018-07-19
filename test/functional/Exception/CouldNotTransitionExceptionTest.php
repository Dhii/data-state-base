<?php

namespace Dhii\Data\Exception\FuncTest;

use Dhii\Data\StateAwareInterface;
use Exception;
use Dhii\Data\Exception\CouldNotTransitionException;
use Dhii\Data\TransitionerInterface;
use Xpmock\TestCase;

/**
 * Tests {@see Dhii\Data\Exception\CouldNotTransitionException}.
 *
 * @since [*next-version*]
 */
class CouldNotTransitionExceptionTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Data\Exception\CouldNotTransitionException';

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
        $subject = new CouldNotTransitionException();

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
            'Dhii\Data\Exception\CouldNotTransitionExceptionInterface',
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
     * Tests the constructor to ensure that all data is correct set.
     *
     * @since [*next-version*]
     */
    public function testConstructor()
    {
        $subject = new CouldNotTransitionException(
            $message = uniqid('message-'),
            $code = rand(),
            $previous = new Exception(),
            $transitioner = $this->createTransitioner(),
            $stateAware = $this->createStateAware(),
            $transition = uniqid('transition-')
        );

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
        $this->assertEquals(
            $transition,
            $subject->getTransition(),
            'Set and retrieved transitions are not the same.'
        );
        $this->assertSame(
            $stateAware,
            $subject->getSubject(),
            'Set and retrieved subject are not the same.'
        );
    }
}

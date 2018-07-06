<?php

namespace Dhii\Data;

use Dhii\Data\Exception\CouldNotTransitionException;
use Dhii\Data\Exception\CouldNotTransitionExceptionInterface;
use Dhii\Data\Exception\TransitionerException;
use Dhii\Util\String\StringableInterface as Stringable;
use Exception as RootException;

/**
 * Common functionality for creating exceptions for when a transitioner fails to transition.
 *
 * @since [*next-version*]
 */
trait CreateCouldNotTransitionExceptionCapableTrait
{
    /**
     * Creates a new exception for when a transitioner fails to transition.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable|null     $message      The error message, if any.
     * @param int|null                   $code         The error code, if any.
     * @param RootException|null         $previous     The previous exception for chaining, if any.
     * @param TransitionerInterface|null $transitioner The transitioner that erred, if any.
     * @param StateAwareInterface|null   $subject      The transition subject, if any.
     * @param string|Stringable|null     $transition   The transitioner that failed, if any.
     *
     * @return CouldNotTransitionExceptionInterface The created exception.
     */
    protected function _createCouldNotTransitionException(
        $message = null,
        $code = null,
        RootException $previous = null,
        $transitioner = null,
        $subject = null,
        $transition = null
    ) {
        return new CouldNotTransitionException($message, $code, $previous, $transitioner, $subject, $transition);
    }
}

<?php

namespace Dhii\Data;

use Dhii\Data\Exception\TransitionerException;
use Dhii\Util\String\StringableInterface as Stringable;
use Exception as RootException;

/**
 * Common functionality for creating transitioner exceptions.
 *
 * @since [*next-version*]
 */
trait CreateTransitionerExceptionCapableTrait
{
    /**
     * Creates a new transitioner exception.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable|null     $message      The error message, if any.
     * @param int|null                   $code         The error code, if any.
     * @param RootException|null         $previous     The previous exception for chaining, if any.
     * @param TransitionerInterface|null $transitioner The transitioner that erred, if any.
     *
     * @return TransitionerException
     */
    protected function _createTransitionerException(
        $message = null,
        $code = null,
        RootException $previous = null,
        $transitioner = null
    ) {
        return new TransitionerException($message, $code, $previous, $transitioner);
    }
}

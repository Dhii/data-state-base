<?php

namespace Dhii\Data\Exception;

use Dhii\Data\TransitionerInterface;
use Dhii\Util\String\StringableInterface as Stringable;
use Exception as RootException;

/**
 * An exception that is thrown is relation to a transitioner.
 *
 * @since [*next-version*]
 */
class TransitionerException extends AbstractBaseTransitionerException
{
    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable|null     $message      The error message, if any.
     * @param int|null                   $code         The error code, if any.
     * @param RootException|null         $previous     The previous exception for chaining, if any.
     * @param TransitionerInterface|null $transitioner The transitioner, if any.
     */
    public function __construct(
        $message = null,
        $code = null,
        $previous = null,
        TransitionerInterface $transitioner = null
    ) {
        $this->_initBaseException($message, $code, $previous);
        $this->_setTransitioner($transitioner);
    }
}

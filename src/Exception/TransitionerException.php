<?php

namespace Dhii\Data\Exception;

use Dhii\Data\TransitionerInterface;
use Dhii\Util\String\StringableInterface as Stringable;
use Exception as RootException;
use InvalidArgumentException;

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
     * @param string|Stringable|int|float|bool|null $message      The message, if any.
     * @param int|float|string|Stringable|null      $code         The numeric error code, if any.
     * @param RootException|null                    $previous     The inner exception, if any.
     * @param TransitionerInterface|null            $transitioner The transitioner, if any.
     *
     * @throws InvalidArgumentException If the message or the code is invalid.
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

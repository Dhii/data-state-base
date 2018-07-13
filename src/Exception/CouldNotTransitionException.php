<?php

namespace Dhii\Data\Exception;

use Dhii\Data\StateAwareAwareTrait;
use Dhii\Data\StateAwareInterface;
use Dhii\Data\StateAwareTrait;
use Dhii\Data\TransitionAwareTrait;
use Dhii\Data\TransitionerInterface;
use Dhii\Util\Normalization\NormalizeStringableCapableTrait;
use Dhii\Util\String\StringableInterface as Stringable;
use Exception as RootException;
use InvalidArgumentException;

/**
 * An exception thrown when a transitioner fails to transition.
 *
 * @since [*next-version*]
 */
class CouldNotTransitionException extends AbstractBaseTransitionerException implements
    CouldNotTransitionExceptionInterface
{
    /* @since [*next-version*] */
    use TransitionAwareTrait {
        _getTransition as public getTransition;
    }

    /* @since [*next-version*] */
    use StateAwareAwareTrait {
        _getStateAware as public getSubject;
        _setStateAware as _setSubject;
    }

    /* @since [*next-version*] */
    use NormalizeStringableCapableTrait;

    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable|int|float|bool|null $message      The message, if any.
     * @param int|float|string|Stringable|null      $code         The numeric error code, if any.
     * @param RootException|null                    $previous     The inner exception, if any.
     * @param TransitionerInterface|null            $transitioner The transitioner, if any.
     * @param StateAwareInterface|null              $subject      The subject, if any.
     * @param string|Stringable|null                $transition   The transition, if any.
     *
     * @throws InvalidArgumentException If the message or the code is invalid.
     */
    public function __construct(
        $message = null,
        $code = null,
        $previous = null,
        TransitionerInterface $transitioner = null,
        $subject = null,
        $transition = null
    ) {
        $this->_initBaseException($message, $code, $previous);
        $this->_setTransitioner($transitioner);
        $this->_setTransition($transition);
        $this->_setSubject($subject);
    }
}

<?php

namespace Dhii\Data\Exception;

use Dhii\Data\TransitionerAwareTrait;
use Dhii\Data\TransitionerInterface;
use Dhii\Exception\CreateInvalidArgumentExceptionCapableTrait;
use Dhii\I18n\StringTranslatingTrait;
use Dhii\Util\String\StringableInterface as Stringable;
use Exception as RootException;

/**
 * Abstract base functionality for exceptions thrown in relation to a transitioner.
 *
 * @since [*next-version*]
 */
abstract class AbstractBaseTransitionerException extends RootException implements TransitionerExceptionInterface
{
    /* @since [*next-version*] */
    use TransitionerAwareTrait {
        _getTransitioner as public getTransitioner;
    }

    /* @since [*next-version*] */
    use CreateInvalidArgumentExceptionCapableTrait;

    /* @since [*next-version*] */
    use StringTranslatingTrait;

    /**
     * Initializes the exception.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable|null     $message      The error message, if any.
     * @param int|null                   $code         The error code, if any.
     * @param RootException|null         $previous     The previous exception for chaining, if any.
     * @param TransitionerInterface|null $transitioner The transitioner, if any.
     */
    public function _init(
        $message = null,
        $code = null,
        $previous = null,
        $transitioner = null
    ) {
        parent::__construct((string) $message, (int) $code, $previous);

        $this->_setTransitioner($transitioner);
    }
}

<?php

namespace Dhii\Data\Exception;

use Dhii\Data\TransitionerAwareTrait;
use Dhii\Exception\AbstractBaseException;
use Dhii\Exception\CreateInvalidArgumentExceptionCapableTrait;
use Dhii\I18n\StringTranslatingTrait;

/**
 * Abstract base functionality for exceptions thrown in relation to a transitioner.
 *
 * @since [*next-version*]
 */
abstract class AbstractBaseTransitionerException extends AbstractBaseException implements TransitionerExceptionInterface
{
    /* @since [*next-version*] */
    use TransitionerAwareTrait {
        _getTransitioner as public getTransitioner;
    }

    /* @since [*next-version*] */
    use CreateInvalidArgumentExceptionCapableTrait;

    /* @since [*next-version*] */
    use StringTranslatingTrait;
}

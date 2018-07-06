<?php

namespace Dhii\Data\Exception;

use Dhii\Data\StateAwareInterface;
use Dhii\Data\StateAwareTrait;
use Dhii\Data\TransitionerInterface;
use Dhii\Exception\CreateInvalidArgumentExceptionCapableTrait;
use Dhii\I18n\StringTranslatingTrait;
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
    use NormalizeStringableCapableTrait;

    /**
     * The transition, if any.
     *
     * @since [*next-version*]
     *
     * @var string|Stringable|null
     */
    protected $transition;

    /**
     * The subject, if any.
     *
     * @since [*next-version*]
     *
     * @var StateAwareInterface|null
     */
    protected $subject;

    /**
     * Constructor.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable|null     $message      The error message, if any.
     * @param int|null                   $code         The error code, if any.
     * @param RootException|null         $previous     The previous exception for chaining, if any.
     * @param TransitionerInterface|null $transitioner The transitioner, if any.
     * @param StateAwareInterface|null   $subject      The subject, if any.
     * @param string|Stringable|null     $transition   The transition, if any.
     */
    public function __construct(
        $message = null,
        $code = null,
        $previous = null,
        TransitionerInterface $transitioner = null,
        $subject = null,
        $transition = null
    ) {
        $this->_init($message, $code, $previous, $transitioner);
        $this->_setTransition($transition);
        $this->_setSubject($subject);
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getTransition()
    {
        return $this->transition;
    }

    /**
     * Sets the transition.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable|null $transition The transition, if any.
     *
     * @throws InvalidArgumentException If the argument is not a string or stringable object.
     */
    protected function _setTransition($transition)
    {
        $this->transition = ($transition !== null)
            ? $this->_normalizeStringable($transition)
            : null;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Sets the subject.
     *
     * @since [*next-version*]
     *
     * @param StateAwareTrait|null $subject The subject, if any.
     *
     * @throws InvalidArgumentException If the argument is not a state-aware object.
     */
    protected function _setSubject($subject)
    {
        if ($subject !== null && !($subject instanceof StateAwareInterface)) {
            throw $this->_createInvalidArgumentException(
                $this->__('Argument is not a state-aware object'), null, null, $subject
            );
        }

        $this->subject = $subject;
    }
}

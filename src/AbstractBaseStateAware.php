<?php

namespace Dhii\Data;

use Dhii\Collection\MapInterface;
use Dhii\Exception\CreateInvalidArgumentExceptionCapableTrait;
use Dhii\I18n\StringTranslatingTrait;

/**
 * Base abstract functionality for objects that are aware of their state.
 *
 * @since [*next-version*]
 */
abstract class AbstractBaseStateAware implements StateAwareInterface
{
    /* @since [*next-version*] */
    use StateAwareTrait {
        _getState as public getState;
    }

    /* @since [*next-version*] */
    use CreateInvalidArgumentExceptionCapableTrait;

    /* @since [*next-version*] */
    use StringTranslatingTrait;

    /**
     * Initializes the instance.
     *
     * @since [*next-version*]
     *
     * @param MapInterface $state The state to create the instance with.
     */
    protected function _init(MapInterface $state)
    {
        $this->_setState($state);
    }
}

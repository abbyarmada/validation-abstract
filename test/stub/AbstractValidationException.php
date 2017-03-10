<?php

namespace Dhii\Validation\TestStub;

use Dhii\Validation\Exception\ValidationExceptionInterface;

/**
 * Enables the mock of `ValidationExceptionInterface` to be a valid
 * exception.
 *
 * @since [*next-version*]
 */
abstract class AbstractValidationException extends \Exception implements ValidationExceptionInterface
{
}

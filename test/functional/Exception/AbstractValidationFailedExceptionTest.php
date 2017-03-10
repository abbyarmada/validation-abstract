<?php

namespace Dhii\Validation\FuncTest;

use Xpmock\TestCase;

/**
 * Tests {@see Dhii\Validation\AbstractValidationFailedException}.
 *
 * @since [*next-version*]
 */
class AbstractValidationFailedExceptionTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Validation\\Exception\\AbstractValidationFailedException';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return AbstractValidationFailedException
     */
    public function createInstance()
    {
        $me = $this;
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
                ->_createValidationException(function ($message) use (&$me) {
                    return $me->mock('Dhii\\Validation\\TestStub\\AbstractValidationException')
                            ->new($message);
                })
                ->new();

        return $mock;
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInstanceOf(static::TEST_SUBJECT_CLASSNAME, $subject, 'Could not create a valid instance');
        $this->assertInstanceOf('Exception', $subject, 'Subject must be a valid exception');
    }

    /**
     * Tests that validation errors are set and retrieved correctly.
     *
     * @since [*next-version*]
     */
    public function testGetSetValidationErrors()
    {
        $subject = $this->createInstance();
        $data = array('banana', 'orange', 'apple');
        $reflection = $this->reflect($subject);

        $this->assertEquals(array(), $reflection->_getValidationErrors(), 'Validation errors could not be set/retrieved correctly');

        $reflection->_setValidationErrors($data);
        $this->assertEquals($data, $reflection->_getValidationErrors(), 'Validation errors could not be set/retrieved correctly');
    }

    /**
     * Tests that settings invalid validation error list results in an exception.
     * 
     * @expectedException \Dhii\Validation\Exception\ValidationExceptionInterface
     *
     * @since [*next-version*]
     */
    public function testSetValidationErrorsThrows()
    {
        $subject = $this->createInstance();
        $data = 'banana';
        $reflection = $this->reflect($subject);

        $reflection->_setValidationErrors($data);
    }

    /**
     * Tests that the validation subject is set and retrieved correctly.
     *
     * @since [*next-version*]
     */
    public function testGetSetValidationSubject()
    {
        $subject = $this->createInstance();
        $data = 'banana';
        $reflection = $this->reflect($subject);

        $reflection->_setValidationSubject($data);
        $this->assertEquals($data, $reflection->_getValidationSubject(), 'Validation subject could not be set/retrieved correctly');
    }
}

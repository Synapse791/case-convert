<?php

namespace Neuron;

use PHPUnit\Framework\TestCase;
use Neuron\Str;
use Neuron\Exceptions\InputCaseNotRecognisedException;

class ConvertorTest extends TestCase
{
    /**
     * @test
     */
    function can_load_a_plain_case_string()
    {
        $return = Str::convert('Example Test String');

        $this->assertInstanceOf(Str::class, $return);
        $this->assertEquals('Example Test String', $return->getString());
        $this->assertEquals(['example', 'test', 'string'], $return->getWords());
    }

    /**
     * @test
     */
    function can_load_a_kebab_case_string()
    {
        $return = Str::convert('example-test-string');

        $this->assertInstanceOf(Str::class, $return);
        $this->assertEquals('example-test-string', $return->getString());
        $this->assertEquals(['example', 'test', 'string'], $return->getWords());
    }

    /**
     * @test
     */
    function can_load_a_snake_case_string()
    {
        $return = Str::convert('example_test_string');

        $this->assertInstanceOf(Str::class, $return);
        $this->assertEquals('example_test_string', $return->getString());
        $this->assertEquals(['example', 'test', 'string'], $return->getWords());
    }

    /**
     * @test
     */
    function can_load_a_camel_case_string()
    {
        $return = Str::convert('exampleTestString');

        $this->assertInstanceOf(Str::class, $return);
        $this->assertEquals('exampleTestString', $return->getString());
        $this->assertEquals(['example', 'test', 'string'], $return->getWords());
    }

    /**
     * @test
     */
    function throws_exception_when_case_not_recognised()
    {
        try {
            Str::convert('example_failure-String');
        } catch (InputCaseNotRecognisedException $e) {
            return;
        }

        $this->fail('No exception was thrown when input case was not recognised');
    }
}

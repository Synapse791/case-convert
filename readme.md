# Case Convert

[![Build Status](https://travis-ci.org/Synapse791/case-convert.svg?branch=master)](https://travis-ci.org/Synapse791/case-convert)

PHP Package to convert strings between cases

## Usage
Pull in the composer package using the following command:

    composer require synapse/case-convert

Then import and use the `Str` class.

    use Neuron\Str;

    $convert = Str::convert('Example test string');
    echo $convert->toSnakeCase(); // "example_test_string"
    echo $convert->toKebabCase(); // "example-test-string"
    echo $convert->toCamelCase(); // "exampleTestString"
    echo $convert->toCamelCaseUpperFirstLetter(); // "ExampleTestString"

For one off conversions, you can easily change the `to...Case` method onto the `convert` method:

    Str::convert('example-test-string')->toPlainSentence(); // "Example test string"

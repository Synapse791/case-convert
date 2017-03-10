<?php

namespace Neuron;

use Neuron\Exceptions\InputCaseNotRecognisedException;

class Str
{
    private $string = '';

    private $words = [];

    private $caseName = '';

    private static $caseMatchers = [
        'plain' => '/[^\s]+\s([^\s]+\s)+[^\s]+/',
        'kebab' => '/^([A-Za-z0-9]+\-)+[A-Za-z0-9]+$/',
        'snake' => '/^([A-Za-z0-9]+_)+[A-Za-z0-9]+$/',
        'camel' => '/[A-Z]?[a-z0-9]+[A-Z][a-z0-9]+([A-Z][a-z0-9])/'
    ];

    public function __construct($string, $caseName, $words)
    {
        $this->string = $string;
        $this->caseName = $caseName;
        $this->words = $words;
    }

    public static function convert($string)
    {
        $parts = [];

        if (preg_match(self::$caseMatchers['plain'], $string)) {
            $parts = explode(' ', $string);
            $caseName = 'plain';
        }

        if (preg_match(self::$caseMatchers['kebab'], $string)) {
            $parts = explode('-', $string);
            $caseName = 'kebab';
        }

        if (preg_match(self::$caseMatchers['snake'], $string)) {
            $parts = explode('_', $string);
            $caseName = 'snake';
        }

        if (preg_match(self::$caseMatchers['camel'], $string)) {
            $parts = preg_split('/(?=[A-Z])/', $string);
            $caseName = 'camel';
        }

        if (empty($parts))
            throw new InputCaseNotRecognisedException;

        return new self($string, $caseName, array_map(function ($item) {
            return strtolower($item);
        }, $parts));
    }

    public function getString()
    {
        return $this->string;
    }

    public function getWords()
    {
        return $this->words;
    }

    public function getCaseName()
    {
        return $this->caseName;
    }

    public function toPlainSentence()
    {
        $parts = $this->words;
        $parts[0] = ucfirst($parts[0]);
        return implode(' ', $parts);
    }

    public function toKebabCase()
    {
        return implode('-', $this->words);
    }

    public function toSnakeCase()
    {
        return implode('_', $this->words);
    }

    public function toCamelCase()
    {
        return implode('', array_map(function ($item, $index) {
            return $index === 0 ? $item : ucfirst($item);
        }, $this->words, array_keys($this->words)));
    }

    public function toCamelCaseUpperFirstLetter()
    {
        return implode('', array_map(function ($item) {
            return ucfirst($item);
        }, $this->words));
    }
}

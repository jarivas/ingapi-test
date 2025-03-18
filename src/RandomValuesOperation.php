<?php

declare(strict_types=1);

namespace INGApi;

use Exception;

enum RandomValuesOperation: string
{
    private const string SEPARATOR = '+';

    case Numbers   = 'NUMBERS';
    case Lowercase = 'LOWERCASE';
    case Uppercase = 'UPPERCASE';
    case Symbol    = 'SYMBOL';
    case All       = 'ALL';
    case List      = 'LIST';
    case Custom    = 'CUSTOM';


    /**
     * Summary of fromString
     * @param string $values
     * @return array<RandomValuesOperation>
     */
    public static function fromString(string $values): array
    {
        $result = [];

        if (!str_contains($values, self::SEPARATOR)) {
            return self::fromStringSingle($values);
        }

        $items = explode(self::SEPARATOR, $values);

        // @phpstan-ignore empty.variable
        if (empty($items)) {
            throw new Exception("fromString error, malformed string $values");
        }

        foreach ($items as $value) {
            $enum = self::tryFrom($value);

            if (!$enum) {
                throw new Exception("fromString error, malformed string $values");
            }

            $result[] = $enum;
        }

        return $result;

    }//end fromString()


    /**
     * Summary of fromStringSingle
     * @param string $values
     * @throws \Exception
     * @return RandomValuesOperation[]
     */
    private static function fromStringSingle(string $values): array
    {
        $enum = self::tryFrom($values);

        if (!$enum) {
            throw new Exception("fromString error, malformed string $values");
        }

        return [$enum];

    }//end fromStringSingle()


}//end enum

<?php


declare(strict_types=1);

namespace INGApi;

use Exception;

define('FUNCTION_START_TAG', '[MACRO]');
define('FUNCTION_END_TAG', '[#MACRO]');

define('FUNCTION_START_TAG_LENGTH', strlen(FUNCTION_START_TAG));
define('FUNCTION_END_TAG_LENGTH', strlen(FUNCTION_END_TAG));

define('FUNCTION_START_TAG_ESCAPED', '\[MACRO\]');
define('FUNCTION_END_TAG_ESCAPED', '\[\#MACRO\]');

define('RANDOM_LOWERCASE', 'abcdefghijklmnopqrstuvwxyz');
define('RANDOM_LOWERCASE_COUNT', strlen(RANDOM_LOWERCASE));

define('RANDOM_UPPERCASE', 'ABCDEFGHIJKLMNOPQRSTUVWXY');
define('RANDOM_UPPERCASE_COUNT', strlen(RANDOM_UPPERCASE));

define('RANDOM_NUMBER', '0123456789');
define('RANDOM_NUMBER_COUNT', strlen(RANDOM_NUMBER));

define('RANDOM_SYMBOL', '~!@$%^&*.;:?');
define('RANDOM_SYMBOL_COUNT', strlen(RANDOM_SYMBOL));

define('RANDOM_VALUE_CHARSET', RANDOM_LOWERCASE.RANDOM_UPPERCASE.RANDOM_NUMBER.RANDOM_NUMBER.RANDOM_SYMBOL);
define('RANDOM_VALUE_CHARSET_COUNT', strlen(RANDOM_VALUE_CHARSET));


define('FUNCTION_REGEX_PATTERN', '/'.FUNCTION_START_TAG_ESCAPED.'(.*)\((.*)\)'.FUNCTION_END_TAG_ESCAPED.'/');

// SYSTEM FUNCTIONS.
define('FUNCTION_BASE64_ENCODE', 'base64_encode');
define('FUNCTION_BASE64_DECODE', 'base64_decode');
define('FUNCTION_JSON_ENCODE', 'json_encode');
define('FUNCTION_JSON_DECODE', 'json_decode');

define('FUNCTION_JSON_PATH', 'json_path');
define('FUNCTION_XML_JSON', 'xml_json');
define('FUNCTION_MD5', 'md5');
define('FUNCTION_HTML_ENTITIES', 'htmlentities');
define('FUNCTION_HTML_ENTITY_DECODE', 'html_entity_decode');
define('FUNCTION_HTML_SPECIAL_CHARS', 'htmlspecialchars');
define('FUNCTION_HTML_SPECIAL_CHARS_DECODE', 'htmlspecialchars_decode');
define('FUNCTION_URL_ENCODE', 'urlencode');
define('FUNCTION_URL_DECODE', 'urldecode');
define('FUNCTION_STRIP_TAGS', 'strip_tags');
define('FUNCTION_IMPLODE', 'implode');
define('FUNCTION_EXPLODE', 'explode');
define('FUNCTION_IS_ARRAY', 'is_array');
define('FUNCTION_IS_OBJECT', 'is_object');
define('FUNCTION_IS_NUMERIC', 'is_numeric');
define('FUNCTION_IS_BOOL', 'is_bool');
define('FUNCTION_IS_STRING', 'is_string');
define('FUNCTION_PREG_REPLACE', 'preg_replace');
define('FUNCTION_GZDEFLATE', 'deflate');
define('FUNCTION_GZINFLATE', 'inflate');
define('FUNCTION_GZCOMPRESS', 'compress');
define('FUNCTION_GZUNCOMPRESS', 'uncompress');
define('FUNCTION_UNIQID', 'uniqid');
define('FUNCTION_RANDOM_INT', 'random_int');
define('FUNCTION_RAW_URLENCODE', 'rawurlencode');
define('FUNCTION_TIME', 'time');


// CUSTOM FUNCTIONS.
define('FUNCTION_GET_LETTER_CONTENT', 'get_letter_content');
define('FUNCTION_GET_LETTER_HTML', 'get_letter_html');
define('FUNCTION_GET_CONTENT', 'get_content');
define('FUNCTION_GET_PLAIN_TEXT_CONTENT', 'get_plaintext_block_content');
define('FUNCTION_GET_LETTER_PDF', 'get_letter_pdf');
define('FUNCTION_GET_LETTER_HTML_NO_IMAGES', 'get_letter_html_no_images');
define('FUNCTION_GET_LETTER_HTML_SUBJECT', 'get_letter_html_subject');
define('FUNCTION_GET_CONTENT_SUBJECT', 'get_content_subject');
define('FUNCTION_GET_IMAGES_OF_LETTER', 'get_images_of_letter');
define('FUNCTION_GET_RAW_IMAGES_OF_LETTER', 'get_raw_images_of_letter');
define('FUNCTION_GET_FILE', 'get_file');
define('FUNCTION_GET_FILE_PATH', 'get_file_path');
define('FUNCTION_GET_MEGAMAIL_ATTACHMENTS', 'get_megamail_attachments');
define('FUNCTION_MOVE_TO_FLOW', 'move_to_flow');
define('FUNCTION_CRC32', 'crc32');
define('FUNCTION_CRYPT', 'crypt');
define('FUNCTION_NL2BR', 'nl2br');
define('FUNCTION_NUMBER_FORMAT', 'number_format');
define('FUNCTION_RANDOM', 'special_random');
define('FUNCTION_ROUND', 'round');
define('FUNCTION_STR_PAD', 'str_pad');
define('FUNCTION_STR_REPEAT', 'str_repeat');
define('FUNCTION_STR_REPLACE', 'str_replace');
define('FUNCTION_STR_SHUFFLE', 'str_shuffle');
define('FUNCTION_STR_CONTAINS', 'str_contains');
define('FUNCTION_STR_STARTS_WITH', 'str_starts_with');
define('FUNCTION_STR_ENDS_WITH', 'str_ends_with');
define('FUNCTION_REMOVE_BREAK_LINES', 'remove_break_lines');
define('FUNCTION_REMOVE_BREAK_LINES_JSON', 'remove_break_lines_json');
define('FUNCTION_HEX2BIN', 'hex2bin');
define('FUNCTION_RTRIM', 'rtrim');
define('FUNCTION_LTRIM', 'ltrim');
define('FUNCTION_TRIM', 'trim');
define('FUNCTION_SHA1', 'sha1');
define('FUNCTION_SIMILAR_TEXT', 'similar_text');
define('FUNCTION_STRTOLOWER', 'strtolower');
define('FUNCTION_STRTOUPPER', 'strtoupper');
define('FUNCTION_STRLEN', 'strlen');
define('FUNCTION_STRPOS', 'strpos');
define('FUNCTION_STRIPOS', 'stripos');
define('FUNCTION_SUBSTR', 'substr');
define('FUNCTION_LCFIRST', 'lcfirst');
define('FUNCTION_UCFIRST', 'ucfirst');
define('FUNCTION_UCWORDS', 'ucwords');
define('FUNCTION_DATE', 'date');
define('FUNCTION_DATE_FORMAT', 'date_format');
define('FUNCTION_DATE_FORMAT_LANG', 'date_format_lang');
define('FUNCTION_DATE_ADD', 'date_add');
define('FUNCTION_DATE_SUB', 'date_sub');

define('FUNCTION_DATE_TO_TIMESTAMP', 'date_to_timestamp');
define('FUNCTION_DATE_DIFF', 'date_diff');
define('FUNCTION_ADDITION', 'sum');
define('FUNCTION_MULTIPLY', 'multiply');
define('FUNCTION_DIVISION', 'division');
define('FUNCTION_SUBTRACTION', 'subtract');
define('FUNCTION_OPPOSITE', 'opposite');
define('FUNCTION_MB_CONVERT_ENCODING', 'mb_convert_encoding');
define('FUNCTION_EVAL_SPREADSHEET_FORMULA', 'eval_spreadsheet_formula');
define('FUNCTION_LEVENSHTEIN', 'levenshtein');
define('FUNCTION_HASH_HMAC', 'hash_hmac');
define('FUNCTION_STRTOOBJECT', 'str_to_object');
define('FUNCTION_GET_PUBLIC_URL', 'get_public_url');
define('FUNCTION_IF', 'if');
define(
    'ALLOWED_FUNCTIONS',
    [
        FUNCTION_BASE64_ENCODE             => false,
        FUNCTION_BASE64_DECODE             => false,
        FUNCTION_JSON_ENCODE               => false,
        FUNCTION_JSON_DECODE               => false,
        FUNCTION_XML_JSON                  => false,
        FUNCTION_MD5                       => false,
        FUNCTION_HTML_ENTITIES             => false,
        FUNCTION_HTML_ENTITY_DECODE        => false,
        FUNCTION_HTML_SPECIAL_CHARS        => false,
        FUNCTION_HTML_SPECIAL_CHARS_DECODE => false,
        FUNCTION_URL_ENCODE                => false,
        FUNCTION_URL_DECODE                => false,
        FUNCTION_STRIP_TAGS                => false,
        FUNCTION_IMPLODE                   => false,
        FUNCTION_EXPLODE                   => false,
        FUNCTION_IS_ARRAY                  => false,
        FUNCTION_IS_BOOL                   => false,
        FUNCTION_IS_NUMERIC                => false,
        FUNCTION_IS_OBJECT                 => false,
        FUNCTION_IS_STRING                 => false,
        FUNCTION_GZDEFLATE                 => false,
        FUNCTION_GZINFLATE                 => false,
        FUNCTION_GZCOMPRESS                => false,
        FUNCTION_GZUNCOMPRESS              => false,
        FUNCTION_UNIQID                    => false,
        FUNCTION_RANDOM_INT                => false,
        FUNCTION_RAW_URLENCODE             => false,
        FUNCTION_TIME                      => false,
        FUNCTION_GET_LETTER_CONTENT        => false,
        FUNCTION_GET_LETTER_HTML           => false,
        FUNCTION_GET_PLAIN_TEXT_CONTENT    => false,
        FUNCTION_GET_LETTER_PDF            => false,
        FUNCTION_GET_LETTER_HTML_NO_IMAGES => false,
        FUNCTION_GET_LETTER_HTML_SUBJECT   => false,
        FUNCTION_GET_IMAGES_OF_LETTER      => false,
        FUNCTION_GET_RAW_IMAGES_OF_LETTER  => false,
        FUNCTION_GET_FILE                  => false,
        FUNCTION_GET_CONTENT               => false,
        FUNCTION_GET_CONTENT_SUBJECT       => false,
        FUNCTION_GET_FILE_PATH             => false,
        FUNCTION_GET_MEGAMAIL_ATTACHMENTS  => false,
        FUNCTION_MOVE_TO_FLOW              => false,
        FUNCTION_CRC32                     => false,
        FUNCTION_CRYPT                     => false,
        FUNCTION_NL2BR                     => false,
        FUNCTION_NUMBER_FORMAT             => false,
        FUNCTION_RANDOM                    => false,
        FUNCTION_ROUND                     => false,
        FUNCTION_STR_PAD                   => false,
        FUNCTION_STR_REPEAT                => false,
        FUNCTION_STR_REPLACE               => false,
        FUNCTION_STR_SHUFFLE               => false,
        FUNCTION_STR_CONTAINS              => false,
        FUNCTION_STR_STARTS_WITH           => false,
        FUNCTION_STR_ENDS_WITH             => false,
        FUNCTION_REMOVE_BREAK_LINES        => false,
        FUNCTION_REMOVE_BREAK_LINES_JSON   => false,
        FUNCTION_HEX2BIN                   => false,
        FUNCTION_RTRIM                     => false,
        FUNCTION_LTRIM                     => false,
        FUNCTION_TRIM                      => false,
        FUNCTION_SHA1                      => false,
        FUNCTION_SIMILAR_TEXT              => false,
        FUNCTION_STRTOLOWER                => false,
        FUNCTION_STRTOUPPER                => false,
        FUNCTION_STRLEN                    => false,
        FUNCTION_STRPOS                    => false,
        FUNCTION_STRIPOS                   => false,
        FUNCTION_SUBSTR                    => false,
        FUNCTION_LCFIRST                   => false,
        FUNCTION_UCFIRST                   => false,
        FUNCTION_UCWORDS                   => false,
        FUNCTION_DATE                      => false,
        FUNCTION_DATE_FORMAT               => false,
        FUNCTION_DATE_FORMAT_LANG          => false,
        FUNCTION_DATE_ADD                  => false,
        FUNCTION_DATE_SUB                  => false,
        FUNCTION_DATE_DIFF                 => false,
        FUNCTION_ADDITION                  => false,
        FUNCTION_MULTIPLY                  => '\\INGApi\\TestToolHelper::multiply',
        FUNCTION_DIVISION                  => '\\INGApi\\TestToolHelper::division',
        FUNCTION_SUBTRACTION               => false,
        FUNCTION_OPPOSITE                  => false,
        FUNCTION_MB_CONVERT_ENCODING       => false,
        FUNCTION_EVAL_SPREADSHEET_FORMULA  => false,
        FUNCTION_LEVENSHTEIN               => false,
        FUNCTION_HASH_HMAC                 => false,
        FUNCTION_PREG_REPLACE              => false,
        FUNCTION_STRTOOBJECT               => false,
        FUNCTION_GET_PUBLIC_URL            => false,
        FUNCTION_IF                        => false,
        FUNCTION_JSON_PATH                 => false,
        FUNCTION_DATE_TO_TIMESTAMP         => false,
    ]
);

define('MAX_RANDOM_LENGTH', 2048);

class TestTools
{


    /**
     * This function is receiving a string that contains macro formulas and it replaces all the formulas with
     * corresponding result.
     *
     * @param string $string
     * @param bool   $escapeResult
     * @param bool   $throwError
     * If we want that the result of the function is escaped (for double quotes and \)
     *
     * @return mixed
     * @throws Exception
     */
    public static function getFormulaFunctions(string $string, bool $escapeResult=false, bool $throwError=false): mixed
    {
        $result        = false;
        $countStartTag = substr_count($string, FUNCTION_START_TAG);
        $countEndTag   = substr_count($string, FUNCTION_END_TAG);

        try {
            if (!$countStartTag) {
                throw new Exception("getFormulaFunctions error, invalid formatted string $string");
            }

            if ($countStartTag != $countEndTag) {
                throw new Exception("getFormulaFunctions error, malformed string $string");
            }

            if ($countStartTag == 1) {
                $result = self::getFormulacionFunctionSimple($string);
            }

            if ($countStartTag > 1) {
                $result = self::getFormulaFunctionsNested($string, $countStartTag);
            }
        } catch (Exception $exception) {
            if ($throwError) {
                throw $exception;
            }
        }//end try

        return ($escapeResult) ? self::escapeQuotesAndBackslash($result) : $result;

    }//end getFormulaFunctions()


    /**
     * Summary of escapeQuotesAndBackslash
     * @param string $string
     * @param string $quotes
     * @return string
     */
    public static function escapeQuotesAndBackslash(string $string, string $quotes='"'):string
    {
        $string = self::escapeUnescapedQuotes($string, $quotes);

        return self::escapeUnescapedBackslash($string);

    }//end escapeQuotesAndBackslash()


    /**
     * Method to escape the " and '  which are not already escaped
     *
     * @param string $string
     * @param string $quotes
     * Which quote needs to be escaped
     *
     * @return string
     */
    public static function escapeUnescapedQuotes(string $string, string $quotes='"'): string
    {
        $result = preg_replace('/(?<!\\\\)(?:\\\\\\\\)*\K'.$quotes.'/', '\\\\\0', $string);

        if (!is_string($result)) {
            throw new Exception('escapeUnescapedQuotes error non string result');
        }

        return $result;

    }//end escapeUnescapedQuotes()


    /**
     * Method that escapes the unescaped backslashes that are not already being used to escape other characters
     *
     * @param string $string
     *
     * @return string
     */
    public static function escapeUnescapedBackslash(string $string): string
    {
        $result = preg_replace('/\\\\(?<!\\\\\\\\)(?:\\\\\\\\)*(?![\\\\"])/', '\\\\\0', $string);

        if (!is_string($result)) {
            throw new Exception('escapeUnescapedBackslash error non string result');
        }

        return $result;

    }//end escapeUnescapedBackslash()


    /**
     * This function generate random values
     *
     * @param string $type This is the type can be NUMBERS | LOWERCASE | UPPERCASE | SYMBOL or any combination of them like LOWERCASE+UPPERCASE, it can also be ALL | LIST | CUSTOM
     * @param string $list If this parameter is set then the random value is generated from $list. The list has to be separated by '#' character
     * @param int    $length This will be the length of the output
     *
     * @return string
     *
     * self::generateRandomValues('red#sun', 9, 'LIST'); --> sunsunred
     * self::generateRandomValues('', 5, 'ALL'); --> 6qA5*
     * self::generateRandomValues('', 15, 'NUMBERS'); --> 618774390883773
     * self::generateRandomValues('abc', 10, 'CUSTOM'); --> baabbcbaab
     */
    public static function generateRandomValues(string $type='ALL', int $length=10, string $list=''): string|false
    {
        if ($length > MAX_RANDOM_LENGTH) {
            $length = MAX_RANDOM_LENGTH;
        }

        return ($type == RandomValuesOperation::List->value) ? self::generateRandomValuesList($list, $length) : self::generateRandomValuesHelper($type, $length, $list);

    }//end generateRandomValues()


    private static function getFormulacionFunctionSimple(string $formula): mixed
    {
        [
            $functionName,
            $functionParams,
        ] = self::getFormulaFunction($formula);

        return call_user_func_array($functionName, $functionParams);

    }//end getFormulacionFunctionSimple()


    /**
     * Summary of evalFormulaFuncHelper
     * @param string $formula
     * @return array<mixed>
     * @throws Exception
     */
    private static function getFormulaFunction(string $formula): array
    {
        $matches = [];

        preg_match(FUNCTION_REGEX_PATTERN, $formula, $matches);

        if (empty($matches) || empty($matches[1])) {
            throw new Exception("getFormulaFunction error, wrong format $formula");
        }

        $functionName = &$matches[1];

        if (!array_key_exists($functionName,ALLOWED_FUNCTIONS)) {
            throw new Exception("getFormulaFunction error, not allowed $formula");
        }

        $functionParams = isset($matches[2]) ? explode('|', $matches[2]) : [];

        return [
            self::getCallback($functionName),
            $functionParams,
        ];

    }//end getFormulaFunction()


    private static function getFormulaFunctionsNested(string $formula, int $nestedCount): mixed
    {
        $result = null;

        for ($i = 0; $i < $nestedCount; ++$i) {
            $nestedFormula = self::extractInnerFormula($formula);
            $result        = self::getFormulacionFunctionSimple($nestedFormula);

            $formula = str_replace($nestedFormula, strval($result), $formula);
        }

        return $result;

    }//end getFormulaFunctionsNested()


    private static function extractInnerFormula(string $formula): string
    {
        $lastStartTagOcurrencePosition = strripos($formula, FUNCTION_START_TAG);
        $firstEndOcurrencePosition     = stripos($formula, FUNCTION_END_TAG);

        if (is_bool($lastStartTagOcurrencePosition)) {
            throw new Exception("extractInnerFormula error, lastStartTagOcurrencePosition not found $formula");
        }

        if (is_bool($firstEndOcurrencePosition)) {
            throw new Exception("extractInnerFormula error, firstEndOcurrencePosition not found $formula");
        }

        $length = intval(($firstEndOcurrencePosition - $lastStartTagOcurrencePosition) + FUNCTION_END_TAG_LENGTH);

        return substr($formula, $lastStartTagOcurrencePosition, $length);

    }//end extractInnerFormula()


    private static function getCallback(string $functionName): string
    {
        $f = ALLOWED_FUNCTIONS[$functionName];

        return ($f === false) ? $functionName : $f;

    }//end getCallback()


    private static function generateRandomValuesHelper(string $type, int $length, string $list): string|false
    {
        $result = '';
        $max    = 0;

        try {
            $ops = RandomValuesOperation::fromString($type);

            $result = self::generateRandomValuesProcess($ops, $length, $list);

            $max = strlen($result);

            $result = ($max == $length) ? $result : self::generateRandomValuesShortened($result, $length, $max);
        } catch (Exception $exception) {
            $result = false;
        }

        return $result;

    }//end generateRandomValuesHelper()


    /**
     * Summary of generateRandomValuesProcess
     * @param array<RandomValuesOperation> $ops
     * @param int $length
     * @param string $list
     * @throws \Exception
     * @return string
     */
    private static function generateRandomValuesProcess(array $ops, int $length, string $list): string
    {
        $result = '';

        foreach ($ops as $op) {
            $result .= match ($op->value) {
                RandomValuesOperation::Lowercase->value => self::generateRandomValuesLower($length),
                RandomValuesOperation::Uppercase->value => self::generateRandomValuesUpper($length),
                RandomValuesOperation::Numbers->value => self::generateRandomValuesNumbers($length),
                RandomValuesOperation::Symbol->value => self::generateRandomValuesSymbol($length),
                RandomValuesOperation::Custom->value => self::generateRandomValuesCustom($length, $list),
                RandomValuesOperation::All->value => self::generateRandomValuesAll($length),
                default => throw new Exception("generateRandomValuesHelper error, invalid op {$op->value}"),
            };
        }

        return $result;

    }//end generateRandomValuesProcess()


    private static function generateRandomValuesOp(string $charSet, int $charsLength, int $length): string
    {
        $result = '';

        for ($i = 0; $i < $length; ++$i) {
            $index = random_int(0, $charsLength);

            $result .= $charSet[$index];
        }

        return $result;

    }//end generateRandomValuesOp()


    private static function generateRandomValuesLower(int $length): string
    {
        return self::generateRandomValuesOp(RANDOM_LOWERCASE, RANDOM_LOWERCASE_COUNT, $length);

    }//end generateRandomValuesLower()


    private static function generateRandomValuesUpper(int $length): string
    {
        return self::generateRandomValuesOp(RANDOM_UPPERCASE, RANDOM_UPPERCASE_COUNT, $length);

    }//end generateRandomValuesUpper()


    private static function generateRandomValuesNumbers(int $length): string
    {
        return self::generateRandomValuesOp(RANDOM_NUMBER, RANDOM_NUMBER_COUNT, $length);

    }//end generateRandomValuesNumbers()


    private static function generateRandomValuesSymbol(int $length): string
    {
        return self::generateRandomValuesOp(RANDOM_SYMBOL, RANDOM_SYMBOL_COUNT, $length);

    }//end generateRandomValuesSymbol()


    private static function generateRandomValuesCustom(int $length, string $list): string
    {
        $charSet     = RANDOM_VALUE_CHARSET;
        $charsLength = RANDOM_VALUE_CHARSET_COUNT;

        if (!empty($list)) {
            $charSet     = $list;
            $charsLength = strlen($charSet);
        }

        return self::generateRandomValuesOp($charSet, $charsLength, $length);

    }//end generateRandomValuesCustom()


    private static function generateRandomValuesAll(int $length): string
    {
        $result  = self::generateRandomValuesLower($length);
        $result .= self::generateRandomValuesUpper($length);
        $result .= self::generateRandomValuesNumbers($length);
        $result .= self::generateRandomValuesSymbol($length);

        return $result;

    }//end generateRandomValuesAll()


    private static function generateRandomValuesList(string $list, int $length): string
    {
        $items = explode('#', $list);

        // @phpstan-ignore empty.variable
        if (empty($items)) {
            throw new Exception("generateRandomValuesList error, malformed list $list");
        }

        $max    = count($items) - 1;//phpcs:ignore Squiz.Formatting.OperatorBracket.MissingBrackets
        $result = '';

        while (strlen($result) < $length) {
            $index   = random_int(0, $max);
            $result .= $items[$index];
        }

        return $result;

    }//end generateRandomValuesList()


    private static function generateRandomValuesShortened(string $values, int $length, int $max): string
    {
        $result = '';

        --$max;

        for ($i = 0; $i < $length; ++$i) {
            $index   = random_int(0, $max);
            $result .= $values[$index];
        }

        return $result;

    }//end generateRandomValuesShortened()


}//end class

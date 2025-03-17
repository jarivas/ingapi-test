<?php


declare(strict_types=1);

namespace INGApi;

define('FUNCTION_START_TAG', '[MACRO]');
define('FUNCTION_END_TAG', '[#MACRO]');

define('FUNCTION_START_TAG_LENGTH', strlen(FUNCTION_START_TAG));
define('FUNCTION_END_TAG_LENGTH', strlen(FUNCTION_END_TAG));

define('FUNCTION_START_TAG_ESCAPED', '\[MACRO\]');
define('FUNCTION_END_TAG_ESCAPED', '\[\#MACRO\]');

use Exception;

class TestTools
{
    const FUNCTION_REGEX_PATTERN = '/'.FUNCTION_START_TAG_ESCAPED.'(.*)\((.*)\)'.FUNCTION_END_TAG_ESCAPED.'/';

    /** SYSTEM FUNCTIONS */
    const FUNCTION_BASE64_ENCODE = 'base64_encode';
    const FUNCTION_BASE64_DECODE = 'base64_decode';
    const FUNCTION_JSON_ENCODE   = 'json_encode';
    const FUNCTION_JSON_DECODE   = 'json_decode';

    const FUNCTION_JSON_PATH     = 'json_path';
    const FUNCTION_XML_JSON      = 'xml_json';
    const FUNCTION_MD5           = 'md5';
    const FUNCTION_HTML_ENTITIES = 'htmlentities';
    const FUNCTION_HTML_ENTITY_DECODE        = 'html_entity_decode';
    const FUNCTION_HTML_SPECIAL_CHARS        = 'htmlspecialchars';
    const FUNCTION_HTML_SPECIAL_CHARS_DECODE = 'htmlspecialchars_decode';
    const FUNCTION_URL_ENCODE    = 'urlencode';
    const FUNCTION_URL_DECODE    = 'urldecode';
    const FUNCTION_STRIP_TAGS    = 'strip_tags';
    const FUNCTION_IMPLODE       = 'implode';
    const FUNCTION_EXPLODE       = 'explode';
    const FUNCTION_IS_ARRAY      = 'is_array';
    const FUNCTION_IS_OBJECT     = 'is_object';
    const FUNCTION_IS_NUMERIC    = 'is_numeric';
    const FUNCTION_IS_BOOL       = 'is_bool';
    const FUNCTION_IS_STRING     = 'is_string';
    const FUNCTION_PREG_REPLACE  = 'preg_replace';
    const FUNCTION_GZDEFLATE     = 'deflate';
    const FUNCTION_GZINFLATE     = 'inflate';
    const FUNCTION_GZCOMPRESS    = 'compress';
    const FUNCTION_GZUNCOMPRESS  = 'uncompress';
    const FUNCTION_UNIQID        = 'uniqid';
    const FUNCTION_RANDOM_INT    = 'random_int';
    const FUNCTION_RAW_URLENCODE = 'rawurlencode';
    const FUNCTION_TIME          = 'time';


    /** CUSTOM FUNCTIONS */

    const FUNCTION_GET_LETTER_CONTENT     = 'get_letter_content';
    const FUNCTION_GET_LETTER_HTML        = 'get_letter_html';
    const FUNCTION_GET_CONTENT            = 'get_content';
    const FUNCTION_GET_PLAIN_TEXT_CONTENT = 'get_plaintext_block_content';
    const FUNCTION_GET_LETTER_PDF         = 'get_letter_pdf';
    const FUNCTION_GET_LETTER_HTML_NO_IMAGES = 'get_letter_html_no_images';
    const FUNCTION_GET_LETTER_HTML_SUBJECT   = 'get_letter_html_subject';
    const FUNCTION_GET_CONTENT_SUBJECT       = 'get_content_subject';
    const FUNCTION_GET_IMAGES_OF_LETTER      = 'get_images_of_letter';
    const FUNCTION_GET_RAW_IMAGES_OF_LETTER  = 'get_raw_images_of_letter';
    const FUNCTION_GET_FILE      = 'get_file';
    const FUNCTION_GET_FILE_PATH = 'get_file_path';
    const FUNCTION_GET_MEGAMAIL_ATTACHMENTS = 'get_megamail_attachments';
    const FUNCTION_MOVE_TO_FLOW = 'move_to_flow';

    const FUNCTION_CRC32 = 'crc32';

    const FUNCTION_CRYPT = 'crypt';

    const FUNCTION_NL2BR = 'nl2br';

    const FUNCTION_NUMBER_FORMAT = 'number_format';

    const FUNCTION_RANDOM = 'special_random';

    const FUNCTION_ROUND = 'round';

    const FUNCTION_STR_PAD = 'str_pad';

    const FUNCTION_STR_REPEAT = 'str_repeat';

    const FUNCTION_STR_REPLACE = 'str_replace';

    const FUNCTION_STR_SHUFFLE = 'str_shuffle';

    const FUNCTION_STR_CONTAINS = 'str_contains';

    const FUNCTION_STR_STARTS_WITH = 'str_starts_with';

    const FUNCTION_STR_ENDS_WITH = 'str_ends_with';

    const FUNCTION_REMOVE_BREAK_LINES = 'remove_break_lines';

    const FUNCTION_REMOVE_BREAK_LINES_JSON = 'remove_break_lines_json';

    const FUNCTION_HEX2BIN = 'hex2bin';

    const FUNCTION_RTRIM = 'rtrim';

    const FUNCTION_LTRIM = 'ltrim';

    const FUNCTION_TRIM = 'trim';

    const FUNCTION_SHA1 = 'sha1';

    const FUNCTION_SIMILAR_TEXT = 'similar_text';

    const FUNCTION_STRTOLOWER = 'strtolower';

    const FUNCTION_STRTOUPPER  = 'strtoupper';
    const FUNCTION_STRLEN      = 'strlen';
    const FUNCTION_STRPOS      = 'strpos';
    const FUNCTION_STRIPOS     = 'stripos';
    const FUNCTION_SUBSTR      = 'substr';
    const FUNCTION_LCFIRST     = 'lcfirst';
    const FUNCTION_UCFIRST     = 'ucfirst';
    const FUNCTION_UCWORDS     = 'ucwords';
    const FUNCTION_DATE        = 'date';
    const FUNCTION_DATE_FORMAT = 'date_format';
    const FUNCTION_DATE_FORMAT_LANG = 'date_format_lang';
    const FUNCTION_DATE_ADD         = 'date_add';
    const FUNCTION_DATE_SUB         = 'date_sub';

    const FUNCTION_DATE_TO_TIMESTAMP   = 'date_to_timestamp';
    const FUNCTION_DATE_DIFF           = 'date_diff';
    const FUNCTION_ADDITION            = 'sum';
    const FUNCTION_MULTIPLY            = 'multiply';
    const FUNCTION_DIVISION            = 'division';
    const FUNCTION_SUBTRACTION         = 'subtract';
    const FUNCTION_OPPOSITE            = 'opposite';
    const FUNCTION_MB_CONVERT_ENCODING = 'mb_convert_encoding';
    const FUNCTION_EVAL_SPREADSHEET_FORMULA = 'eval_spreadsheet_formula';
    const FUNCTION_LEVENSHTEIN    = 'levenshtein';
    const FUNCTION_HASH_HMAC      = 'hash_hmac';
    const FUNCTION_STRTOOBJECT    = 'str_to_object';
    const FUNCTION_GET_PUBLIC_URL = 'get_public_url';
    const FUNCTION_IF       = 'if';
    const MAX_RANDOM_LENGTH = 2048;
    const ALLOWED_FUNCTIONS = [
        self::FUNCTION_BASE64_ENCODE             => false,
        self::FUNCTION_BASE64_DECODE             => false,
        self::FUNCTION_JSON_ENCODE               => false,
        self::FUNCTION_JSON_DECODE               => false,
        self::FUNCTION_XML_JSON                  => false,
        self::FUNCTION_MD5                       => false,
        self::FUNCTION_HTML_ENTITIES             => false,
        self::FUNCTION_HTML_ENTITY_DECODE        => false,
        self::FUNCTION_HTML_SPECIAL_CHARS        => false,
        self::FUNCTION_HTML_SPECIAL_CHARS_DECODE => false,
        self::FUNCTION_URL_ENCODE                => false,
        self::FUNCTION_URL_DECODE                => false,
        self::FUNCTION_STRIP_TAGS                => false,
        self::FUNCTION_IMPLODE                   => false,
        self::FUNCTION_EXPLODE                   => false,
        self::FUNCTION_IS_ARRAY                  => false,
        self::FUNCTION_IS_BOOL                   => false,
        self::FUNCTION_IS_NUMERIC                => false,
        self::FUNCTION_IS_OBJECT                 => false,
        self::FUNCTION_IS_STRING                 => false,
        self::FUNCTION_GZDEFLATE                 => false,
        self::FUNCTION_GZINFLATE                 => false,
        self::FUNCTION_GZCOMPRESS                => false,
        self::FUNCTION_GZUNCOMPRESS              => false,
        self::FUNCTION_UNIQID                    => false,
        self::FUNCTION_RANDOM_INT                => false,
        self::FUNCTION_RAW_URLENCODE             => false,
        self::FUNCTION_TIME                      => false,
        self::FUNCTION_GET_LETTER_CONTENT        => false,
        self::FUNCTION_GET_LETTER_HTML           => false,
        self::FUNCTION_GET_PLAIN_TEXT_CONTENT    => false,
        self::FUNCTION_GET_LETTER_PDF            => false,
        self::FUNCTION_GET_LETTER_HTML_NO_IMAGES => false,
        self::FUNCTION_GET_LETTER_HTML_SUBJECT   => false,
        self::FUNCTION_GET_IMAGES_OF_LETTER      => false,
        self::FUNCTION_GET_RAW_IMAGES_OF_LETTER  => false,
        self::FUNCTION_GET_FILE                  => false,
        self::FUNCTION_GET_CONTENT               => false,
        self::FUNCTION_GET_CONTENT_SUBJECT       => false,
        self::FUNCTION_GET_FILE_PATH             => false,
        self::FUNCTION_GET_MEGAMAIL_ATTACHMENTS  => false,
        self::FUNCTION_MOVE_TO_FLOW              => false,
        self::FUNCTION_CRC32                     => false,
        self::FUNCTION_CRYPT                     => false,
        self::FUNCTION_NL2BR                     => false,
        self::FUNCTION_NUMBER_FORMAT             => false,
        self::FUNCTION_RANDOM                    => false,
        self::FUNCTION_ROUND                     => false,
        self::FUNCTION_STR_PAD                   => false,
        self::FUNCTION_STR_REPEAT                => false,
        self::FUNCTION_STR_REPLACE               => false,
        self::FUNCTION_STR_SHUFFLE               => false,
        self::FUNCTION_STR_CONTAINS              => false,
        self::FUNCTION_STR_STARTS_WITH           => false,
        self::FUNCTION_STR_ENDS_WITH             => false,
        self::FUNCTION_REMOVE_BREAK_LINES        => false,
        self::FUNCTION_REMOVE_BREAK_LINES_JSON   => false,
        self::FUNCTION_HEX2BIN                   => false,
        self::FUNCTION_RTRIM                     => false,
        self::FUNCTION_LTRIM                     => false,
        self::FUNCTION_TRIM                      => false,
        self::FUNCTION_SHA1                      => false,
        self::FUNCTION_SIMILAR_TEXT              => false,
        self::FUNCTION_STRTOLOWER                => false,
        self::FUNCTION_STRTOUPPER                => false,
        self::FUNCTION_STRLEN                    => false,
        self::FUNCTION_STRPOS                    => false,
        self::FUNCTION_STRIPOS                   => false,
        self::FUNCTION_SUBSTR                    => false,
        self::FUNCTION_LCFIRST                   => false,
        self::FUNCTION_UCFIRST                   => false,
        self::FUNCTION_UCWORDS                   => false,
        self::FUNCTION_DATE                      => false,
        self::FUNCTION_DATE_FORMAT               => false,
        self::FUNCTION_DATE_FORMAT_LANG          => false,
        self::FUNCTION_DATE_ADD                  => false,
        self::FUNCTION_DATE_SUB                  => false,
        self::FUNCTION_DATE_DIFF                 => false,
        self::FUNCTION_ADDITION                  => false,
        self::FUNCTION_MULTIPLY                  => 'self::multiply',
        self::FUNCTION_DIVISION                  => 'self::division',
        self::FUNCTION_SUBTRACTION               => false,
        self::FUNCTION_OPPOSITE                  => false,
        self::FUNCTION_MB_CONVERT_ENCODING       => false,
        self::FUNCTION_EVAL_SPREADSHEET_FORMULA  => false,
        self::FUNCTION_LEVENSHTEIN               => false,
        self::FUNCTION_HASH_HMAC                 => false,
        self::FUNCTION_PREG_REPLACE              => false,
        self::FUNCTION_STRTOOBJECT               => false,
        self::FUNCTION_GET_PUBLIC_URL            => false,
        self::FUNCTION_IF                        => false,
        self::FUNCTION_JSON_PATH                 => false,
        self::FUNCTION_DATE_TO_TIMESTAMP         => false,
    ];


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
     * @param string $list If this parameter is set then the random value is generated from $list. The list has to be separated by '#' character
     * @param int    $length This will be the length of the output
     * @param string $type This is the type can be NUMBERS | LOWERCASE | UPPERCASE | SYMBOL or any combination of them like LOWERCASE+UPPERCASE, it can also be ALL | LIST | CUSTOM
     *
     * @return string
     *
     * self::generateRandomValues('red#sun', 9, 'LIST'); --> sunsunred
     * self::generateRandomValues('', 5, 'ALL'); --> 6qA5*
     * self::generateRandomValues('', 15, 'NUMBERS'); --> 618774390883773
     * self::generateRandomValues('abc', 10, 'CUSTOM'); --> baabbcbaab
     */
    public static function generateRandomValues(string $list='', int $length=10, string $type='ALL')
    {

        return "";

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

        preg_match(self::FUNCTION_REGEX_PATTERN, $formula, $matches);

        if (empty($matches) || empty($matches[1])) {
            throw new Exception("getFormulaFunction error, wrong format $formula");
        }

        $functionName = &$matches[1];

        if (!isset(self::ALLOWED_FUNCTIONS[$functionName])) {
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
        $f = self::ALLOWED_FUNCTIONS[$functionName];

        return ($f === false) ? $functionName : $f;

    }//end getCallback()


    /**
     * Summary of division
     * @param array<float> $numbers
     * @return float
     * @phpstan-ignore method.unused
     */
    private static function division(...$numbers): float
    {
        $max    = count($numbers);
        $result = $numbers[0];

        for ($i = 1; $i < $max; ++$i) {
            $result /= $numbers[$i];
        }

        return $result;

    }//end division()


    /**
     * Summary of multiply
     * @param array<float> $numbers
     * @return float
     * @phpstan-ignore method.unused
     */
    private static function multiply(...$numbers): float
    {
        $max    = count($numbers);
        $result = $numbers[0];

        for ($i = 1; $i < $max; ++$i) {
            $result *= $numbers[$i];
        }

        return $result;

    }//end multiply()


}//end class

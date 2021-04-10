<?php

namespace Helpers;

use Helpers\CommonHelpers as ch;
use Exception;
use DateTime;

class CommonHelpers
{
    /**
     * Returns value from $array ($dict) by $key if is set
     * or returns $substitute (null by default) as default value
     * @param string $key
     * @param array $dict
     * @param null $substitute
     * @return mixed|null
     */
    static public function getArrayValue(string $key, array $dict, $substitute=null)
    {
        return isset($dict[$key]) ? $dict[$key] : $substitute;
    }


    /**
     * Checks the $stringVal is string and length > 0
     * @param mixed $value
     * @return bool
     */
    static public function isFilledString($value): bool
    {
        return is_string($value) && (strlen($value) > 0);
    }


    /**
     * @param string $paramName
     * @param array $paramValues
     * @param null $substitute
     * @return mixed|null
     */
    static public function getFirstValue(string $paramName, array $paramValues, $substitute = null)
    {
        $values = ch::getArrayValue($paramName, $paramValues, null);
        return is_array($values) ? (isset($values[0]) ? $values[0] : $substitute) : $substitute;
    }


    /**
     * @param string $target
     * @param mixed $substitute
     */
    static public function fromJSON(string $target, $substitute = [])
    {
        try {
            $r = json_decode($target, true);
        } catch (Exception $e) {
            return $substitute;
        }

        return is_array($r) ? $r : $substitute;
    }


    /**
     * @param string $val
     * @return string
     */
    static public function toStrict(string $val): string
    {
        return "'" . $val . "'";
    }


    /**
     * @param array $data
     * @param string $columnName
     * @return float
     */
    static public function getSumByColumn(string $columnName, array &$data): float
    {
        $result = 0.00;

        foreach ($data as $row) {
            $result +=   is_numeric(self::getArrayValue($columnName, $row, 0.00))
                       ? floatval(self::getArrayValue($columnName, $row, 0.00))
                       : 0;
        }

        return floatval($result);
    }


    /**
     * @param float ...$args
     * @return float
     */
    static public function getSum(float ...$args): float
    {
        $result = 0.00;

        foreach ($args as $value) {
            $result +=   is_numeric($value)
                       ? floatval($value)
                       : 0.00;
        }

        return $result;
    }


    /**
     * Converts hours to seconds
     * @param float $hours
     * @return int
     */
    static public function convertHoursToSeconds(float $hours): int
    {
        if ($hours < 0)
            return 0;

        return intval(round($hours * 3600));
    }

    /**
     * Converts hours to minutes
     * @param float $hours
     * @return int
     */
    static public function convertHoursToMinutes(float $hours): int
    {
        if ($hours < 0)
            return 0;

        return intval(round($hours * 60));
    }


    /**
     * @param DateTime $date
     * @param int $additionalSeconds
     * @return DateTime
     */
    static public function modifyDate(DateTime $date, int $additionalSeconds): DateTime
    {
        $addInterval = new \DateInterval("PT{$additionalSeconds}S");

        return $date->add($addInterval);
    }


    /**
     * @param mixed $var
     * @return array
     */
    static public function asArray(&$var): array
    {
        if (!is_array($var))
            $var = [];
    }
}

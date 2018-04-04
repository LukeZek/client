<?php

namespace LukeBozek\ApiClient\Util;

class ArrayNodeExtractor
{
    /**
     * @return mixed
     */
    public static function extractArrayNode(array $array, array $node)
    {
        if (empty($node)) {
            return $array;
        } else {
            $singleLevel = array_shift($node);

            if (!isset($array[$singleLevel])) {
                return $array;
            }

            if (!is_array($array[$singleLevel])) {
                return $array[$singleLevel];
            }

            return self::extractArrayNode($array[$singleLevel], $node);
        }
    }
}

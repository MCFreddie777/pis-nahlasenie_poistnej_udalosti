<?php

function arrayExclude($array, array $excludeKeys, $returnBoth = false)
{
    $excluded = [];
    foreach ($excludeKeys as $key) {
        $excluded[$key] = $array[$key];
        unset($array[$key]);
    }
    if ($returnBoth)
        return [
            'items' => $array,
            'excluded' => $excluded
        ];

    return $array;
}

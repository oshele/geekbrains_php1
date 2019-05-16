<?php

require_once __DIR__ . '//../config/config.php';

function sum($a, $b)
{
    return $a + $b;
}


function diff($a, $b)
{
    return $a - $b;
}


function mult($a, $b)
{
    return $a * $b;
}


function div($a, $b)
{
    if($b != 0){
        return $a / $b;
    }
    return 'На 0 делить нельзя!';

}

function mathOperation($arg1, $arg2, $operation)
{
    if(is_numeric($arg1) && is_numeric($arg2)){
        switch ($operation) {
            case "sum":
                return sum($arg1, $arg2);
                break;
            case "diff":
                return diff($arg1, $arg2);
                break;
            case "mult":
                return mult($arg1, $arg2);
                break;
            case "div":
                return div($arg1, $arg2);
                break;
            default:
                echo ("Незнакомая математическая операция");
                break;
        }
    }

}
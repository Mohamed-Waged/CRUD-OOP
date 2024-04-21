<?php

function sanitizeValue($input)
{
    return htmlentities(trim($input));
}

function requireValue($input)
{
    if ($input != '') {
        return false;
    }else{
        return true;
    }
}

function minLength($input , $length) {
    if(strlen($input) < $length){
        return true ;
    }
    return false ;
}

function maxLength($input , $length) {
    if(strlen($input) > $length){
        return true ;
    }
    return false ;
}
<?php

/**
 * input
 *
 * @author Pavel
 */
class Input
{
    
static $auto_strip_tags=false;    
    
public static function post( $key = '', $default = NULL)
{
    $value = arr::get($_POST, $key, $default);

    if( self::$auto_strip_tags && is_string($value))
    {
    $value = strip_tags($value);
    }

    return $value;
}

public static function get( $key = '', $default = NULL)
{
    $value = arr::get($_GET, $key, $default);

    if( self::$auto_strip_tags && is_string($value))
    {
        $value = strip_tags($value);
    }

    return $value;
    }
}



?>


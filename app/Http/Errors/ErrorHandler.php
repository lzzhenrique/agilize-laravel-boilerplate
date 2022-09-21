<?php

namespace App\Http\Errors;


class ErrorHandler
{
    public static function handleException(\Exception $e)
    {
        var_dump('HANDLE EXCEPTION');
        throw new \Exception(
            $e->getMessage() . ' in ' .  $e->getFile() . '  ' . $e->getLine()
            );
    }
}
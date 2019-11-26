<?php

function __autoload($className)
{
    if(file_exists(__DIR__ . '/' . $className . '.php')) {
        require_once __DIR__ . '/' . $className . '.php';
        return true;
    }

    return false;
}

foreach($composer['autoload']['classmap'] ?? [] as $val) {
    __autoload($val);
}

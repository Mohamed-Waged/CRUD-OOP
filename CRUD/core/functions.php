<?php

function checkRequestMethod(string $method): bool 
{
    return $_SERVER['REQUEST_METHOD'] === $method;
}

function redirectPath(string $url): void
{
    header("Location: $url");
    exit();
}


function sessionStore($key, $value)
{
    $_SESSION[$key] = $value;
}

function sessionRemove($name)
{
    if (isset($_SESSION[$name])) {
        unset($_SESSION[$name]);
    }
}


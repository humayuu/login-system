<?php

function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    filter_var($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    return $data;
}

function testEmail($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    filter_var($data, FILTER_SANITIZE_EMAIL);

    return $data;
}

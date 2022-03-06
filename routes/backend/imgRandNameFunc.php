<?php
function randomImg($image)
{

    $test = explode('.', $image);
    $ext = end($test);
    $name = rand(100, 999) . '.' . $ext;

    return $name;
}

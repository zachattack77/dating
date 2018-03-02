<?php
/**
 * Created by PhpStorm.
 * User: Zach Kunitsa
 * Date: 2/26/2018
 */

function validName($name)
{
    if(!empty($name) && is_string($name))
    {
        return true;
    }
    else
    {
        return false;
    }
}
function validAge($age)
{
    if (is_numeric($age) && $age >= 18)
    {
        return true;
    }
    else
    {
        return false;
    }
}
function validPhone($phone)
{
    if(is_numeric($phone) && strlen((string)$phone) == 10)
    {
        return true;
    }
    else
    {
        return false;
    }
}


$errors = array();

if(!validName($fname) || !validName($lname))
{
    $errors['name']="Please enter a valid name.";
    echo "ERROR";
}

if(!validAge($age)) {
    $errors['age'] = "Please enter a valid age";
}
if(!validPhone($phone))
{
    $errors['phone'] = "Please enter a valid phone number. (No dashes)";
}


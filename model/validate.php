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


function validOutdoor($outdoor)
{
    if(!empty($outdoor)) {
        foreach ($outdoor as $activity) {
            if ($activity != "hiking" && $activity != "biking" &&
                $activity != "swimming" && $activity != "collecting" &&
                $activity != "walking" && $activity != "climbing") {
                return false;
            }
        }
    }else{
        return false;
    }
    return true;
}

function validIndoor($indoor)
{
    if(!empty($indoor)) {
        foreach ($indoor as $activity) {
            if ($activity != "tv" && $activity != "movies" && $activity != "cooking" &&
                $activity != "board games" && $activity != "puzzles" && $activity != "reading"
                && $activity != "cards" && $activity != "video games") {
                return false;
            }
        }
    }else{
        return false;
    }
    return true;
}
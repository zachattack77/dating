<?php
/**
 * Created by PhpStorm.
 * User: Zach Kunitsa
 * Date: 1/10/2018
 */


// Turn on error reporting
ini_set("display_errors", 1);
error_reporting(E_ALL);


require_once('vendor/autoload.php');
session_start();


$f3 = Base::instance();

//Set debug level
$f3->set('DEBUG', 3);

$f3 -> route('GET /', function() {
    $template = new Template();
    echo $template->render('pages/home.html');
}
);

//Personal Information Page
$f3 -> route('GET|POST /personal', function($f3) {
    if(isset($_POST['submit']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $errors = $_POST['errors'];
        $premium = $_POST['premium'];

        include('model/validate.php');

        if(!isset($errors['name']) && !isset($errors['age']) && !isset($errors['phone']))
        {
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['age'] = $age;
            $_SESSION['gender'] = $gender;
            $_SESSION['phone'] = $phone;
            $_SESSION['premium'] = $premium;

            if(!isset($_SESSION['premium']))
            {
                $member = new Member($fname, $lname, $age, $gender, $phone);
                $_SESSION['member'] = $member;
            }
            else
            {
                $member = new PremiumMember($_SESSION['fname'], $_SESSION['lname'],
                    $_SESSION['age'], $_SESSION['gender'], $_SESSION['phone']);
                $_SESSION['member'] = $member;
            }
            header("Location:profile");
        }
    }
    $f3->set('fname',$fname);
    $f3->set('lname',$lname);
    $f3->set('age',$age);
    $f3->set('gender',$gender);
    $f3->set('phone',$phone);
    $f3->set('premium',$premium);
    $f3->set('errors',$errors);


    $template = new Template();
    echo $template->render('pages/personal.html');
});

//Profile page
$f3 -> route('GET|POST /profile', function($f3) {
    if(isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $state = $_POST['state'];
        $seeking = $_POST['seeking'];
        $bio = $_POST['bio'];

        $f3->set('email',$email);
        $f3->set('state',$state);
        $f3->set('seeking',$seeking);
        $f3->set('bio',$bio);

        $_SESSION['email'] = $_POST['email'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['bio'] = $_POST['bio'];

        $member = $_SESSION['member'];
        $member->setEmail($_SESSION['email']);
        $member->setState($_SESSION['state']);
        $member->setSeeking($_SESSION['seeking']);
        $member->setBio($_SESSION['bio']);
        $_SESSION['member'] = $member;

        if(!isset($_SESSION['premium']))
        {
            header("Location:summary");
        }
        else
        {
            header("Location:interests");
        }
    }

    $template = new Template();
    echo $template->render('pages/profile.html');
});

$f3->route('GET|POST /interests', function($f3) {
    if(isset($_POST['submit']))
    {
        $indoor = $_POST['indoor'];
        $outdoor = $_POST['outdoor'];
        $errors = $_POST['errors'];

        header("Location:summary");
    }

    $f3->set('indoor',$indoor);
    $f3->set('outdoor',$outdoor);
    $f3->set('errors',$errors);

    $template = new Template();
    echo $template->render('pages/interests.html');
});

$f3->route('GET|POST /summary', function($f3) {

    $f3->set('fname',$_SESSION['fname']);
    $f3->set('lname',$_SESSION['lname']);
    $f3->set('age',$_SESSION['age']);
    $f3->set('gender',$_SESSION['gender']);
    $f3->set('phone',$_SESSION['phone']);
    $f3->set('email',$_SESSION['email']);
    $f3->set('seeking',$_SESSION['seeking']);
    $f3->set('state',$_SESSION['state']);
    $f3->set('bio',$_SESSION['bio']);
    $f3->set('indoor',$_SESSION['indoor']);
    $f3->set('outdoor',$_SESSION['outdoor']);
    $f3->set('premium', $_SESSION['premium']);
    $f3->set('member', $_SESSION['member']);

    $template = new Template();
    echo $template->render('pages/summary.html');
});

//Run Fat-Free Framework
//tests
$f3->run();

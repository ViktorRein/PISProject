<?php
if(isset($_POST['submit']))
{
    require_once 'function1.inc.php';
    require_once 'dbpdo1.inc.php';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(emptyInputsSignUp($name,$email,$password))
    {
        header('location: ../registr.php?error=emptyinput');
        exit;
    }
    if(!Correctpassword($password))
    {
         header('location: ../registr.php?error=notvalidpasswoard');
         exit();
    }
    if(EmailExist($conn,$name))
    {
        header('location: ../registr.php?error=UserExist');
        exit();
    }
        Createuser($conn,$name,$email,$password);
        header(header: 'location: ../game.php');
        exit;
}
?>
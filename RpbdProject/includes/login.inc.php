<?php
if (isset($_POST['submit']))
{
    require_once 'function1.inc.php';
    require_once 'dbpdo1.inc.php';
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(Admin($conn, $username, $password))
    {
        $_SESSION['username'] = $_POST['username'];
        header(header: 'location: ../admin.php');
        exit;
    }
    if(login($conn, $username, $password))
    {
        $_SESSION['username'] = $_POST['username'];
        header(header: 'location: ../game.php');
        exit;
    }
    else
    {
        header(header: 'location: ../login.php?error=invalidlogin');
        exit;
    }
    exit();
}
?>
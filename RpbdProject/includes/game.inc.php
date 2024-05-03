<?php
if (isset($_POST['quit']))
{       
        session_destroy();
        header(header: 'location: ../login.php');
}
if (isset($_POST['profile']))
{       
        header(header: 'location: ../profile.php');
}
?>
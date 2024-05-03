<?php
function emptyInputsSignUp($name, $email,$password)
{
    $result = '';
    if(empty($name) || empty($email) || empty($password))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function Createuser($conn,$name,$email,$password){
    $sql = "INSERT INTO users (username, email, password) VALUES(?,?,?);";
    $hash = password_hash($password, PASSWORD_DEFAULT);
    try{
        $stmt = $conn ->prepare($sql);
        $stmt->execute([$name,$email,$hash]);
    }
    catch(PDOException $e){
        echo 'error' . $e ->getMessage();
        exit();
    }


}

function Correctpassword($password)
{
    $result = "";
    if(strlen($password) < 8){
        $result = false;
    }
    if (!preg_match('/[a-zA-Z]/', $password)) {
        return false;
    }
    if(!preg_match('/[0-9]/',$password)){
        return false;
    }
    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        return false;
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }
    $result = true;
    return $result;
}
function PasswordHash($password)
{
    $hash = password_hash($password, PASSWORD_DEFAULT);
    return $hash;
}

function EmailExist($conn,$username){
    $result = "";
    $sql = "SELECT username FROM users WHERE username = ?";
    try
    {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);
        
        $username = $stmt->fetchColumn();
 
        if($username)
        {
            $result = true;
        }
        else
        {
            $result = false;
        }
        return $result;
    }
    catch(PDOExpection $e)
    {
        echo $e->getMessage();
        header('location:../registr.php&error=EmailExist');
        exit();
    }
}
function login($conn, $username, $password)
{
    $sql = "SELECT password FROM users WHERE username = ?";
    $result;
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);
        $pwd = $stmt->fetchColumn();
        if($password)
        {
            
            if(password_verify($password,$pwd))
            {
                $result = true;
            }
            else
            {
                $result = false;
            }
            
        }
        else
        {
            $result = false;
        }
        return $result;

    } catch(PDOException $e) {
        echo "Connection failed " . $e->getMessage();
        exit();
    }
}
function Admin($conn, $username, $password)
{
    $sql = "SELECT password, role_id FROM users WHERE username = ?";
    $result;
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $pwd = $row['password'];
        $role_id = $row['role_id'];

        if ($password) {
            if (password_verify($password, $pwd) && $role_id == 1) {
                $result = true;
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }
        return $result;
    } catch (PDOException $e) {
        echo "Connection failed " . $e->getMessage();
        exit();
    }
}
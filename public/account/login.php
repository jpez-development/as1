<?php
session_start();
$pageTitle = 'iBuy - Login';
$pageContent = '<p>Don\'t have an account?<a href=\'register.php\'>Click here to register</a></p>
    <h1>Login</h1>
    <form action="login.php" method="POST">
    <label>Email</label> <input name="email" type="email" placeholder="john.doe@example.com"/>
    <label>Password</label> <input name="password" type="password" placeholder="password"/>
    <input name="submit" type="submit" value="Submit" />
    </form>';
$stylesheet = '../assets/ibuy.css';
require '../../layout.php';
require_once '../../functions.php';

$pdo = startDB();

if (isset($_POST['submit'])) {
    $user = getFirstAllMatches('users', 'email', $_POST['email']); //get the first match of an all column query
    if($user) { //if the user exists
        if (password_verify($_POST['password'], $user['password'])) { //if the entered and stored passwords match
            $_SESSION['loggedin'] = $user['user_id'];
            if ($user['admin'] === 'y') {
                $_SESSION['admin'] = 'y';
            }
            echo'<script>window.location.href = "../index.php";</script>'; //redirect
            
        }
        else {
            echo '<p>Unsuccessful Login</p>';
        }
    }
    else {
        echo '<p>Unsuccessful Login</p>';
    }
}
?>
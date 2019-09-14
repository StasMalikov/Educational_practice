<?php
$login = $_POST['login'];
$pswd = $_POST['password'];
$type = "";

session_start();

$_SESSION['user_name'] = $login;

$crypt_passwd = crypt($pswd, $login);

require_once 'login.php';
$conn = new mysqli($hn, $user, $password, $database);
if ($conn->connect_error) die("Fatal Error");

$query  = "SELECT Id,Password FROM Students WHERE Login='$login'";
$result = $conn->query($query);
if (!$result) die("Fatal Error");

if ($result->num_rows == 0) {

    $query  = "SELECT Id,Password FROM Lecturers WHERE Login='$login'  ";

    $result = $conn->query($query);
    if (!$result) die("Fatal Error");

    if ($result->num_rows == 0) {
        header('Location: http://localhost/Educational_practice/loggin_notification.html');
     } else {

        $row = $result->fetch_array(MYSQLI_ASSOC);

        if ($crypt_passwd == htmlspecialchars($row['Password'])) {
            $_SESSION['type']='lecturer';
            $_SESSION['Id']=htmlspecialchars($row['Id']);
            header('Location: http://localhost/Educational_practice/create_rep_faculty.php');
        } else {
            header('Location: http://localhost/Educational_practice/loggin_notification.html');
        }
    }
} else {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($crypt_passwd == htmlspecialchars($row['Password'])) {
        $_SESSION['type']='student';
        $_SESSION['Id']=htmlspecialchars($row['Id']);
        $_SESSION['user_name'] = $login;
        header('Location: http://localhost/Educational_practice/student_index.php');

     } else {
        header('Location: http://localhost/Educational_practice/loggin_notification.html');
    }
}

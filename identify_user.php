<?php
$login=$_POST['login'];
$pswd=$_POST['password'];
$type="";

require_once 'login.php';
$conn = new mysqli($hn, $user, $password, $database);
if ($conn->connect_error) die("Fatal Error");

$query  = "SELECT Password FROM Students WHERE Login='$login'";
$result = $conn->query($query);
if (!$result) die("Fatal Error");

$rows = $result->num_rows;

if($rows==0){

    $query  = "SELECT Password FROM Lecturers WHERE Login='$login'";
    $result = $conn->query($query);
    if (!$result) die("Fatal Error");
    $row = $result->fetch_array(MYSQLI_ASSOC);
    
    if( $pswd == htmlspecialchars($row['Password'])){

        $url = 'http://localhost/Educational_practice/create_rep_faculty.php';
        $params = array(
        'user_name' => "$login"
        );
        $result = file_get_contents($url, false, stream_context_create(array(
        'http' => array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query($params)
        )
        )));
 
        echo $result;

    }else{
        echo 'Неправильный пароль';
    }

}else{

    $row = $result->fetch_array(MYSQLI_ASSOC);
    if( $pswd == htmlspecialchars($row['Password'])){

    }else{
        echo 'Неправильный пароль';
    }
}
?>
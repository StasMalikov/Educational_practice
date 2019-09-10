<?php
$login=$_POST['login'];
$pswd=$_POST['password'];


require_once 'login.php';
$conn = new mysqli($hn, $user, $password, $database);
if ($conn->connect_error) die("Fatal Error");

$query  = "SELECT Password,Type FROM Users WHERE Login='$login'";
$result = $conn->query($query);
if (!$result) die("Fatal Error");

$rows = $result->num_rows;

if($rows==0){
echo 'Пользователь не найден';
}else{
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if( $pswd == htmlspecialchars($row['Password'])){
        if(htmlspecialchars($row['Type'])=="lecturer"){

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

        }else if(htmlspecialchars($row['Type'])=="student"){

        }
    }else{
        echo 'Неправильный пароль';
    }
}
?>
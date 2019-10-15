<?php
                              //обработка данных, введённых на форме авторизации, 
                              //и при совпадении логина и пароля перенаправление на соответстующую странучку
                              
$login = htmlentities($_POST['login']);
$pswd = htmlentities($_POST['password']);

session_start();

$_SESSION['user_name'] = $login;



// получаем хеш пароля введённого пользователем на форме, логин используем как соль(модификатор)
$crypt_passwd = crypt($pswd, $login);

require_once 'login.php';
$conn = new mysqli($hn, $user, $password, $database);
if ($conn->connect_error) die("Fatal Error");

// ищем в базе данных студентов с введённым логином
$query  = "SELECT Id,Password FROM Students WHERE Login='$login'";
$result = $conn->query($query);
if (!$result) die("Fatal Error");

if ($result->num_rows != 0)
{
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($crypt_passwd == htmlspecialchars($row['Password'])) 
    {
        $_SESSION['Id']=htmlspecialchars($row['Id']);
        header('Location: http://localhost/Educational_practice/stud/student_index.php');
    }
}
else{

// если не нашли не одного студента, то пробуем найти преподователей
$query  = "SELECT Id,Password FROM Lecturers WHERE Login='$login'";
$result = $conn->query($query);
if (!$result) die("Fatal Error");

if ($result->num_rows != 0)
{
    $row = $result->fetch_array(MYSQLI_ASSOC);

        if ($crypt_passwd == htmlspecialchars($row['Password'])) 
        {
            $_SESSION['Id']=htmlspecialchars($row['Id']);
            header('Location: http://localhost/Educational_practice/lect/create_rep_faculty.php');
        }
}else   
    {
        // если не нашли не одного преподавателя, то пробуем найти администраторов
        $query  = "SELECT Id,Password FROM Administrators WHERE Login='$login'  ";
        $result = $conn->query($query);
        if (!$result) die("Fatal Error");
        if ($result->num_rows != 0)
        {
            $row = $result->fetch_array(MYSQLI_ASSOC);

             if ($crypt_passwd == htmlspecialchars($row['Password'])) 
            {
            $_SESSION['Id']=htmlspecialchars($row['Id']);
            header('Location: http://localhost/Educational_practice/admin/add_stud.php');
            }
        }
            else
            {
            $result->close();
            $conn->close();
            $_SESSION['message']='Неправильно введён логин или пароль.';
             header('Location: http://localhost/Educational_practice/index.php');
            }
    }
}
?>

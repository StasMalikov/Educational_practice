<?php
                                                    //добавление в базу данных нового преподавателя
session_start();

// проверка пользователя
if(!isset($_SESSION['user_name'])){
    header('Location: http://localhost/Educational_practice/loggin.php');
}
$user_name=$_SESSION['user_name'];

$name=$_POST['name'];
$name_sec=$_POST['name_second'];
$name_patr=$_POST['name_patronic'];
$faculty=$_POST['faculty'];
$degree=$_POST['degree'];
$login = htmlentities($_POST['login']);
$pswd = htmlentities($_POST['password']);

// получаем хеш пароля введённого пользователем на форме, логин используем как соль(модификатор)
$crypt_passwd = crypt($pswd, $login);

require_once '../login.php';
$conn = new mysqli($hn, $user, $password, $database);
if ($conn->connect_error) die("Fatal Error");

$query  = "INSERT INTO Lecturers VALUES(NULL,'$name','$name_sec','$name_patr','$faculty','$degree','$login','$crypt_passwd')";
$result = $conn->query($query);

$message='Преподаватель успешно зарегистрирован.';
if (!$result) {
    $message='При регистрации возникла ошибка: '. $conn->error;
}


echo <<< _END
<html lang="ru">
<html>

<head>
    <meta charset="utf-8">
    <title>Аттестационная ведомость онлайн</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class='container-fluid'>

        <h2 align='center'>Аттестационная ведомость онлайн</h2>
        <hr>
        <div class='row'>
        <div class='col-md-9'>
        <ul class='list-inline list-unstyled'>
        <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg"  href='add_stud.php'>Добавить студента</a></li>
        <li class="list-inline-item"><a role="button" class="btn btn-info btn-lg"  href='add_lect.php'>Добавить преподавателя</a></li>
        <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg"  href='add_subj.php'>Добавить предмет</a></li>
        <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg"  href='add_subj_stud.php'>Запись студента на предмет</a></li>
        <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg"  href='add_subj_lect.php'>Запись преподавателя на предмет</a></li>
        </ul>
        <hr>
        
        </div>
        <div class='col-md-3' align='right'>
        <ul class='list-inline list-unstyled'>
            <li class="list-inline-item"><button type="button" class="btn btn btn-outline-primary btn-lg" disabled>$user_name</button></li>
            <li class="list-inline-item"><a role="button" class="btn btn-outline-danger btn-lg" href='../loggin.php'>Выход</a></li>
        </ul>
        <hr>
        
        </div>
        
        </div>
        
        <h4>Регистрация нового преподователя</h4>

        <div class='row'>

            <div class='col-md-6'>
            <div class="alert alert-info" role="alert">
           $message
        </div>
            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
_END;
?>
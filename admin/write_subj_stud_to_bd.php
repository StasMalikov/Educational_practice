<?php
                                                    //добавление в базу данных нового предмета
session_start();

// проверка пользователя
if(!isset($_SESSION['user_name'])){
    header('Location: http://localhost/Educational_practice/index.php');
}
$user_name=$_SESSION['user_name'];

$subj_name=$_POST['subject'];
$faculty=$_POST['faculty'];
$group=$_POST['group'];
$sup_group=$_POST['sub_group'];
$kurs=$_POST['kurs'];


require_once '../login.php';
$conn = new mysqli($hn, $user, $password, $database);
if ($conn->connect_error) die("Fatal Error");

$query  = "SELECT Id FROM Faculties WHERE Name='$faculty'";
$result = $conn->query($query);

$row = $result->fetch_array(MYSQLI_ASSOC);
$faculty_id=htmlspecialchars($row['Id']);

$query  = "SELECT Id FROM Subjects WHERE Name='$subj_name' ";
$result = $conn->query($query);

$row = $result->fetch_array(MYSQLI_ASSOC);
$subj_id=htmlspecialchars($row['Id']);

if($sup_group=="-"){
    $query  = "SELECT Id FROM Students WHERE FacultyId='$faculty_id' and Class='$group'and Kurs='$kurs' ";
}else{
    $query  = "SELECT Id FROM Students WHERE FacultyId='$faculty_id' and Class='$group'and SubClass='$sup_group' and Kurs='$kurs' ";
}

$result = $conn->query($query);

$rows = $result->num_rows;

if($rows==0){
    $message='Ошибка: Введены некоректные данные. ';
}else {
    for ($j = 0 ; $j < $rows ; ++$j)
    {
    
      $row = $result->fetch_array(MYSQLI_ASSOC);
      $id=htmlspecialchars($row['Id']);

      $query2  = "INSERT INTO Student_Subject VALUES(NULL,'$id','$subj_id')";
      $result2 = $conn->query($query2);

    }
    $message='Студенты успешно добавлены.';
}

if (!$result) {
    $message='При добавлении возникла ошибка: '. $conn->error;
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
        <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg"  href='add_lect.php'>Добавить преподавателя</a></li>
        <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg"  href='add_subj.php'>Добавить предмет</a></li>
        <li class="list-inline-item"><a role="button" class="btn btn-info btn-lg"  href='add_subj_stud.php'>Запись студентов на предмет</a></li>
        <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg"  href='add_subj_lect.php'>Запись преподавателя на предмет</a></li>
        </ul>
        <hr>
        
        </div>
        <div class='col-md-3' align='right'>
        <ul class='list-inline list-unstyled'>
            <li class="list-inline-item"><button type="button" class="btn btn btn-outline-primary btn-lg" disabled>$user_name</button></li>
            <li class="list-inline-item"><a role="button" class="btn btn-outline-danger btn-lg" href='../index.php'>Выход</a></li>
        </ul>
        <hr>
        
        </div>
        
        </div>
        
        <h4>Запись студентов на предмет</h4>

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
<?php
$faculty=$_POST['faculty'];
$kurs=$_POST['kurs'];
$class=$_POST['group'];
$subclass=$_POST['sub_group'];

$point=".";
if($subclass==="-"){
    $subclass='';
    $point='';
}



echo <<<_END
<html lang="ru">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class='container-fluid'>

        <h2 align='center'>Аттестационная ведомость онлайн</h2>
        <hr>
        <ul class='list-inline list-unstyled'>
        <li class="list-inline-item"><a role="button" class="btn btn-info btn-lg" title='Создание новой ведомости' href='create_rep_faculty.php'>Добавление</a></li>
            <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg" title='Редактирование уже существующей ведомости' href='edit_exist_report.html'>Редактирование</a></li>
            <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg" title='Просмотр существующих ведомостей'>Просмотр</a></li>
        </ul>
        <hr>

        <h4>Настройка ведомости</h4>
        <hr>
        <form method="post" action="create_rep_subject.php">
           <div class='row'>
        
            <div class='col-md-12'>
            <div class='row'>
            <div class='col-md-1'>
                <label>Факультет</label>
            </div>
            <div class='col-md-2'>
                <!-- вставка названия факультета -->
                <label><b id='faculty'>$faculty</b></label>
            </div>

            <div class='col-md-2'>
                <label>Курс</label>
            </div>
            <div class='col-md-1'>
                <!-- вставка курса -->
                <label><b id='kurs'>$kurs</b></label>
            </div>

            <div class='col-md-1'>
                <label>Группа</label>
            </div>
            <div class='col-md-1'>
                <!-- вставка группы -->
                <label><b id='group'>$class$point$subclass</b></label>
            </div>
        </div>
       <hr>
_END;


require_once 'login.php';
$conn = new mysqli($hn, $user, $password, $database);
if ($conn->connect_error) die("Fatal Error");

if($subclass==""){

    $query  = "SELECT DISTINCT Name FROM 
    (SELECT SubjectId FROM students JOIN
     student_subject ON students.Id=student_subject.StudentId WHERE
      students.Kurs='$kurs' AND students.Faculty='$faculty' AND Students.Class='$class') 
      as result JOIN subjects on result.SubjectID=subjects.Id";
}else{
    $query  = "SELECT DISTINCT Name FROM 
    (SELECT SubjectId FROM students JOIN
     student_subject ON students.Id=student_subject.StudentId WHERE students.Kurs='$kurs' AND students.Faculty='$faculty' AND Students.Class='$class' AND Students.SubClass='$subclass') 
      as result JOIN subjects on result.SubjectID=subjects.Id";
}

$result = $conn->query($query);
if (!$result) die($conn->error);

$rows = $result->num_rows;

for ($j = 0 ; $j < $rows ; ++$j)
{
  $row = $result->fetch_array(MYSQLI_ASSOC);
  echo '<option>'   . htmlspecialchars($row['Name'])   . '</option>';
}
?>
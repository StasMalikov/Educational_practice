<?php
$faculty=$_POST['faculty'];
$kurs=$_POST['kurs'];
$class=$_POST['group'];
$subclass=$_POST['sub_group'];
$user_name=$_POST['user_name'];

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
        <div class='row'>
        <div class='col-md-9'>
        <ul class='list-inline list-unstyled'>
            <li class="list-inline-item"><a role="button" class="btn btn-info btn-lg" title='Создание новой ведомости' href='create_rep_faculty.php'>Добавление</a></li>
            <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg" title='Редактирование уже существующей ведомости' href='edit_exist_report.html'>Редактирование</a></li>
            <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg" title='Просмотр существующих ведомостей'>Просмотр</a></li>
        </ul>
        <hr>
        
        </div>
        <div class='col-md-3' align='right'>
        <ul class='list-inline list-unstyled'>
            <li class="list-inline-item"><button type="button" class="btn btn btn-outline-primary btn-lg" disabled>$user_name</button></li>
            <li class="list-inline-item"><a role="button" class="btn btn-outline-danger btn-lg" href='loggin.html'>Выход</a></li>
        </ul>
        <hr>
        
        </div>
        
        </div>

        <h4>Настройка ведомости</h4>
        <hr>
        <form method="post" action="edit_clear_rep.php">
           <div class='row'>
        
            <div class='col-md-12'>
            <div class='row'>
            <div class='col-md-1'>
                <label>Факультет</label>
            </div>
            <div class='col-md-2'>
                <label><b id='faculty'>$faculty</b></label>
            </div>

            <div class='col-md-2'>
                <label>Курс</label>
            </div>
            <div class='col-md-1'>
                <label><b id='kurs'>$kurs</b></label>
            </div>

            <div class='col-md-1'>
                <label>Группа</label>
            </div>
            <div class='col-md-1'>
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
      as result JOIN subjects on result.SubjectId=subjects.Id";
}else{
    $query  = "SELECT DISTINCT Name FROM 
    (SELECT SubjectId FROM students JOIN
     student_subject ON students.Id=student_subject.StudentId WHERE students.Kurs='$kurs' AND students.Faculty='$faculty' AND Students.Class='$class' AND Students.SubClass='$subclass') 
      as result JOIN subjects on result.SubjectId=subjects.Id";
}

$result = $conn->query($query);
if (!$result) die($conn->error);

$rows = $result->num_rows;
if($rows==0){
    echo <<< _END
     <div class="alert alert-primary" role="alert" align='center'>
  Отсутствуют данные для формирования ведомости, попробуйте указать другие данные на предыдущей  <a href="create_rep_groups.php" class="alert-link">вкладке</a>
    </div>'
_END;

}else
{

    echo <<< _END
    <label for="subject">Выберите дисциплину</label>
                        <select class="form-control" name="subject">
_END;
    
for ($j = 0 ; $j < $rows ; ++$j)
{
  $row = $result->fetch_array(MYSQLI_ASSOC);
  echo '<option>'   . htmlspecialchars($row['Name'])   . '</option>';
}
echo <<< _END
</select>
<hr>

<input type="hidden" name="faculty" value="$faculty">
<input type="hidden" name="kurs" value="$kurs">
<input type="hidden" name="group" value="$class">
<input type="hidden" name="sub_group" value="$subclass">
<input type="hidden" name="user_name" value="$user_name">

<button type="submit" class="btn btn-primary">Создать ведомость</button>
                    </div>

            </form>

            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
_END;
}
?>
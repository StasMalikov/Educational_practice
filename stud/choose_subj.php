<?php
                                    //страничка где студент выбирает предмет для просмотра оценок
session_start();
if(!isset($_SESSION['user_name'])){
    header('Location: http://localhost/Educational_practice/index.php');
}

$user_name=$_SESSION['user_name'];


echo <<< _END
<html lang="ru">

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
                <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg" title='Главная' href='student_index.php'>Главная страница</a></li>
                    <li class="list-inline-item"><a role="button" class="btn btn-info btn-lg" title='Главная' href='choose_subj.php'>Просмотр ведомости</a></li>
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

        <h4>Выберите параметры для поиска ведомости</h4>

        <hr>

        <form method="post" action="show_stud_rep.php">
        <div class='row'>
        
        <div class='col-md-6'>

        <label for="faculty">Выберите предмет</label>
                        <select class="form-control" name="subject">
_END;


$StudId=$_SESSION['Id'];

require_once '../login.php';
$conn = new mysqli($hn, $user, $password, $database);
if ($conn->connect_error) die("Fatal Error");

// список предметов по которым у студента есть оценки
$query  = "SELECT DISTINCT Name FROM Subjects JOIN
(SELECT SubjectId FROM Student_Subject WHERE StudentId='$StudId')as result  ON 
result.SubjectId=Subjects.Id";
$result = $conn->query($query);
if (!$result) die($conn->error);

$rows = $result->num_rows;

if($rows==0){}else{
    for ($j = 0 ; $j < $rows ; ++$j)
{
  $row = $result->fetch_array(MYSQLI_ASSOC);
  echo '<option>'   . htmlspecialchars($row['Name'])   . '</option>';
}
}
echo <<< _END
        </select>
        <hr>
        <button type="submit" class="btn btn-primary">Найти ведомость</button>
        </div>
        
        </form>
        </div>
        


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
_END;
$result->close();
$conn->close();
?>
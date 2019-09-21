<?php
session_start();

if(!isset($_SESSION['user_name'])){
    header('Location: http://localhost/Educational_practice/loggin.php');
}

$user_name=$_SESSION['user_name'];
$lecturerId = $_SESSION['Id'];

require_once 'login.php';
$conn = new mysqli($hn, $user, $password, $database);
if ($conn->connect_error) die("Fatal Error");

$query = "SELECT Name, result.Id,Number,SubjectId,DateOfEvent FROM Subjects JOIN 
(SELECT Id,Number,SubjectId,DateOfEvent FROM Attestations WHERE LecturerId='$lecturerId')as result
ON result.SubjectId=Subjects.Id";

$result = $conn->query($query);
if (!$result) die($conn->error);

$rows = $result->num_rows;

echo <<< _END
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
            <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg" title='Создание новой ведомости' href='create_rep_faculty.php'>Добавление</a></li>
            <li class="list-inline-item"><a role="button" class="btn btn-info btn-lg" title='Редактирование уже существующей ведомости' href='find_completed_rep.php'>Редактирование</a></li>
            <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg" title='Просмотр существующих ведомостей'>Просмотр</a></li>
        </ul>
        <hr>
        
        </div>
        <div class='col-md-3' align='right'>
        <ul class='list-inline list-unstyled'>
            <li class="list-inline-item"><button type="button" class="btn btn btn-outline-primary btn-lg" disabled>$user_name</button></li>
            <li class="list-inline-item"><a role="button" class="btn btn-outline-danger btn-lg" href='loggin.php'>Выход</a></li>
        </ul>
        <hr>
        
        </div>
        
        </div>

        <h4>Заполнение ведомости</h4>
        <hr>
        <div class='row'>
            <div class='col-md-12'>

                <div class='row'>

                <!-- таблица -->
                <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Предмет</th>
                                    <th scope="col">№ Аттестации</th>
                                    <th scope="col">Дата</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
_END;

for ($j = 0 ; $j < $rows ; ++$j)
{
  $row = $result->fetch_array(MYSQLI_ASSOC);

echo '<form method="post" action="edit_completed_rep.php">';

echo   '<input type="hidden" name="att_id" value="'.htmlspecialchars($row['Id']).'">'; 
echo '<tr>';
echo '<td>'.htmlspecialchars($row['Name']).'</td>';
echo '<td>'.htmlspecialchars($row['Number']).'</td>';
echo '<td>'.substr(htmlspecialchars($row['DateOfEvent']),0,10).'</td>';
echo '<td><button type="submit" class="btn btn-primary">Редактировать</button></td>';
echo '</tr>';

echo '</form>';
}

echo <<< _END
                            </tbody>
                </table>
                
                </div>
                <hr>
                <!-- ниже не трогать -->
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
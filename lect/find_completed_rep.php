<?php
                                                    //страничка с формой выбора ведомости для редактирования
session_start();

if(!isset($_SESSION['user_name'])){
    header('Location: http://localhost/Educational_practice/loggin.php');
}

$user_name=$_SESSION['user_name'];
$lecturerId = $_SESSION['Id'];

require_once '../login.php';
$conn = new mysqli($hn, $user, $password, $database);
if ($conn->connect_error) die("Fatal Error");

// получаем список аттестаций, которые проводил текущий преподаватель
$query = "SELECT Name, result.Id,Number,SubjectId,DateOfEvent FROM Subjects JOIN 
(SELECT Id,Number,SubjectId,DateOfEvent FROM Attestations WHERE LecturerId='$lecturerId')as result
ON result.SubjectId=Subjects.Id";

$result = $conn->query($query);
if (!$result) die($conn->error);

$rows = $result->num_rows;

echo <<< _END
<html lang="ru">

<head>
<title>Аттестационная ведомость онлайн</title>
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
            <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg" title='Просмотр существующих ведомостей' href='look_at_reps.php'>Просмотр</a></li>
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

        <h4>Выбор ведомости для редактирования</h4>
        <hr>
        <div class='row'>
            <div class='col-md-12'>

                <div class='row'>

                <!-- таблица -->
                <table class="table">
                            <thead>
                                <tr>
                                    <th>Факультет</th>
                                    <th>Курс</th>
                                    <th>Группа</th>
                                    <th scope="col">Предмет</th>
                                    <th scope="col">№ Аттестации</th>
                                    <th scope="col">Дата</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
_END;

// выводим список ведомостей
// каждая строчка в таблице это форма с кнопкой
// при нажатии уходит post запрос с данными о конкретной аттестации

for ($j = 0 ; $j < $rows ; ++$j)
{

  $row = $result->fetch_array(MYSQLI_ASSOC);
  $id=htmlspecialchars($row['Id']);

//   получаем данные о факультете, курсе, группе студентов из аттестации
  $query2 = "SELECT FacultyId,Class,Kurs FROM Students JOIN
  (SELECT StudentId FROM Student_Attestation WHERE AttestationId='$id')as result
  ON Students.Id=result.StudentId";
  
  $result2 = $conn->query($query2);
  if (!$result2) die($conn->error);
  
  $row2 = $result2->fetch_array(MYSQLI_ASSOC);

  $faculty_id=htmlspecialchars($row2['FacultyId']);

  $query3 = "SELECT Name FROM Faculties WHERE Id='$faculty_id' ";
  
  $result3 = $conn->query($query3);
  if (!$result3) die($conn->error);
  
  $row3 = $result3->fetch_array(MYSQLI_ASSOC);

echo '<form method="post" action="edit_completed_rep.php">';

echo   '<input type="hidden" name="att_id" value="'.htmlspecialchars($row['Id']).'">'; 
echo '<tr>';

echo '<td>'.htmlspecialchars($row3['Name']).'</td>';
echo   '<input type="hidden" name="Faculty" value="'.htmlspecialchars($row3['Name']).'">';

echo '<td>'.htmlspecialchars($row2['Kurs']).'</td>';
echo   '<input type="hidden" name="Kurs" value="'.htmlspecialchars($row2['Kurs']).'">';
echo '<td>'.htmlspecialchars($row2['Class']).'</td>';
echo   '<input type="hidden" name="Class" value="'.htmlspecialchars($row2['Class']).'">';
echo '<td>'.htmlspecialchars($row['Name']).'</td>';
echo   '<input type="hidden" name="Name" value="'.htmlspecialchars($row['Name']).'">';
echo '<td>'.htmlspecialchars($row['Number']).'</td>';
echo   '<input type="hidden" name="Number" value="'.htmlspecialchars($row['Number']).'">';
echo '<td>'.substr(htmlspecialchars($row['DateOfEvent']),0,10).'</td>';
echo   '<input type="hidden" name="DateOfEvent" value="'.htmlspecialchars($row['DateOfEvent']).'">';
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
$result->close();
$conn->close();
?>
<?php
                                                    //страничка с формой редактирования уже существующей ведомости
session_start();
if(!isset($_SESSION['user_name'])){
    header('Location: http://localhost/Educational_practice/index.php');
}
$user_name=$_SESSION['user_name'];
  $att_id= $_POST['att_id'];
  $Date=$_POST['DateOfEvent'];
  $Number=$_POST['Number'];
  $Faculty= $_POST['Faculty'];
  $Subj=$_POST['Name'];
  $Kurs=$_POST['Kurs'];
  $Class=$_POST['Class'];

require_once '../login.php';
$conn = new mysqli($hn, $user, $password, $database);
if ($conn->connect_error) die("Fatal Error");

// список студентов, привязанных к выбранной аттестации
$query = "SELECT Id,Name,Surname,Patronymic,Mark FROM Students JOIN 
(SELECT StudentId,Mark FROM Student_Attestation WHERE AttestationId='$att_id')as result
ON Students.Id= result.StudentId ORDER BY Students.Surname";

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
            <li class="list-inline-item"><a role="button" class="btn btn-outline-danger btn-lg" href='../index.php'>Выход</a></li>
        </ul>
        <hr>
        
        </div>
        
        </div>

        <h4>Редактирование ведомости</h4>
        <hr>
        <form method="post" action="write_edited_rep_to_bd.php">
        <div class='row'>

            <div class='col-md-12'>

                <div class='row'>

                    <div class='col-md-1'>
                        <label>Дисциплина</label>
                    </div>
                    <div class='col-md-2'>
                        <label><b id='subject'>$Subj</b></label>
                    </div>


                    <div class='col-md-2'> <label for="report_number">Номер аттестации</label>
                    </div>
                    <div class='col-md-1'>

                    <label><b>$Number</b></label>

                    </div>

                    <div class='col-md-1'>
                        <label for="date">Дата</label>
                    </div>
                    <div class='col-md-2'>
                    <label><b>
_END;

                   echo substr($Date,0,10);
                    echo <<< _END
                    </b></label>
                    </div>
                </div>

                <hr>
                <div class='row'>
                    <div class='col-md-1'>
                        <label>Факультет</label>
                    </div>
                    <div class='col-md-2'>
                        <label><b id='faculty'>$Faculty</b></label>
                    </div>

                    <div class='col-md-2'>
                        <label>Курс</label>
                    </div>
                    <div class='col-md-1'>
                        <label><b id='kurs'>$Kurs</b></label>
                    </div>

                    <div class='col-md-1'>
                        <label>Группа</label>
                    </div>
                    <div class='col-md-1'>
                        <label><b id='group'>$Class</b></label>
                    </div>
                </div>

                <hr>
                <div class='row'>
                    <div class='col-md-12'>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">№</th>
                                    <th scope="col">Фамилия Имя Отчество</th>
                                    <th scope="col">Аттестационная оценка</th>
                                </tr>
                            </thead>
                            <tbody>
_END;
// выводим студентов
for ($j = 0 ; $j < $rows ; ++$j)
{
  $row = $result->fetch_array(MYSQLI_ASSOC);
  echo '<tr>'.'<th scope="row">';
  echo $j+1;
  echo '</th>'.'<td>'.
  htmlspecialchars($row['Surname']).' '.
  htmlspecialchars($row['Name']).' '.
  htmlspecialchars($row['Patronymic']).'</td>'.
  '<input type="hidden" name="input_student_'."$j". '"'. 'value="'.htmlspecialchars($row['Id']).'">'.
  '<td><input type="number" required min=0 max=50 class="form-control" name="input_mark_'."$j".'" 
  value="'.htmlspecialchars($row['Mark']).'"></td></tr>';
}
echo <<< _END
</tbody>
                        </table>
                    </div>
                </div>
                <input type="hidden" name="att_id" value="$att_id">
                <input type="hidden" name="students_count" value="$rows">
                <button type="action" class="btn btn-primary">Сохранить ведомость</button>
                </form>
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
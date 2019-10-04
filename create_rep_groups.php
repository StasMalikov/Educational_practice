<?php
                                                    //страничка с формой выбора группы и подгруппы создаваемой ведомости
session_start();

if(!isset($_SESSION['user_name'])){
    header('Location: http://localhost/Educational_practice/loggin.php');
}
// используем данные с предыдущей странички для запросов
$faculty=$_POST['faculty'];
$kurs=$_POST['kurs'];
$user_name=$_SESSION['user_name'];

echo <<<_END
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
            <li class="list-inline-item"><a role="button" class="btn btn-info btn-lg" title='Создание новой ведомости' href='create_rep_faculty.php'>Добавление</a></li>
            <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg" title='Редактирование уже существующей ведомости' href='find_completed_rep.php'>Редактирование</a></li>
            <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg" title='Просмотр существующих ведомостей' href='look_at_reps.php'>Просмотр</a></li>
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

                </div>

                <hr>

_END;

require_once 'login.php';
$conn = new mysqli($hn, $user, $password, $database);
if ($conn->connect_error) die("Fatal Error");
// получаем список  групп, для выбранного факультета и курса
$query  = "SELECT DISTINCT Class FROM Students WHERE Faculty='$faculty' AND Kurs='$kurs' ORDER BY Class";
$result = $conn->query($query);
if (!$result) die("Fatal Error");

$rows = $result->num_rows;
if($rows==0){
    echo <<< _END
     <div class="alert alert-primary" role="alert" align='center'>
  Отсутствуют данные для формирования ведомости, попробуйте указать другие данные на предыдущей вкладке
    </div>'
_END;

}else
{
    echo '<label for="group">Выберите группу</label> <select class="form-control" name="group">';

for ($j = 0 ; $j < $rows ; ++$j)
{
  $row = $result->fetch_array(MYSQLI_ASSOC);
  echo '<option>'   . htmlspecialchars($row['Class'])   . '</option>';
}

$result->close();
$conn->close();

echo <<<_END
                </select>

                <label for="sub_group">Выберите подгруппу</label>
                <select class="form-control" name="sub_group">
                <option>-</option>
                <option>1</option>
                <option>2</option>
                </select>
                </div>

                
        </div>
        <hr>
        <input type="hidden" name="faculty" value="$faculty">
        <input type="hidden" name="kurs" value="$kurs">
        <input type="hidden" name="user_name" value="$user_name">
        <button type="submit" class="btn btn-primary">Продолжить настройку ведомости</button>
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
_END;
}
?>
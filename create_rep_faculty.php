<?php
$user_name=$_POST['user_name'];

echo <<< _END
<html lang="ru">
<html>

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
            <li class="list-inline-item"><a role="button" class="btn btn-outline-danger btn-lg">Выход</a></li>
        </ul>
        <hr>
        
        </div>
        
        </div>
        
        <h4>Настройка ведомости</h4>

        <div class='row'>

            <div class='col-md-6'>
                <form method="post" action="create_rep_groups.php">
                    <div class="form-group">
                        <label for="faculty">Выберите факультет</label>
                        <select class="form-control" name="faculty">

_END;
 require_once 'login.php';
 $conn = new mysqli($hn, $user, $password, $database);
 if ($conn->connect_error) die("Fatal Error");

 $query  = "SELECT DISTINCT Faculty FROM Students";
 $result = $conn->query($query);
 if (!$result) die("Fatal Error");

 $rows = $result->num_rows;

 for ($j = 0 ; $j < $rows ; ++$j)
 {

   $row = $result->fetch_array(MYSQLI_ASSOC);
   echo '<option>'   . htmlspecialchars($row['Faculty'])   . '</option>';
 }

 $result->close();
 $conn->close();
echo <<< _END
    </select>

    <label for="kurs">Выберите курс</label>
                        <select class="form-control" name="kurs">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                        </select>

                    </div>
                    <input type="hidden" name="user_name" value="$user_name">
                    <button type="submit" class="btn btn-primary">Продолжить настройку ведомости</button>
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
?>


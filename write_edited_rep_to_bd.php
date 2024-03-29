<?php
                                            //обновляем данные в отредактированной ведомости
session_start();

if(!isset($_SESSION['user_name'])){
    header('Location: http://localhost/Educational_practice/loggin.php');
}

$user_name=$_SESSION['user_name'];
$students_count = $_POST['students_count'];
$att_id=$_POST['att_id'];

require_once 'login.php';
$conn = new mysqli($hn, $user, $password, $database);
if ($conn->connect_error) die("Fatal Error");

// в цикле обновляем поле Mark в таблице student_attestation у всех студентов
for ($j = 0; $j < $students_count; ++$j) {
    
    $post_id_name = 'input_student_' . "$j";
    $stud_id = $_POST["$post_id_name"];

    $post_mark_name = 'input_mark_' . "$j";
    $stud_mark = $_POST["$post_mark_name"];

    $query = "UPDATE student_attestation  SET Mark='$stud_mark' WHERE AttestationId='$att_id' AND StudentId='$stud_id' ";
    $result = $conn->query($query);
}

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
                <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg" title='Создание новой ведомости' href='create_rep_faculty.php'>Добавление</a></li>
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
    
            <div class="alert alert-info" role="alert">
                            Ведомость успешно изменена!
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
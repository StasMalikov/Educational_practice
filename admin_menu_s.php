<?php
                                                    //страничка с формой ввода данных регистрируемого студента
session_start();

// проверка пользователя
if(!isset($_SESSION['user_name'])){
    header('Location: http://localhost/Educational_practice/loggin.php');
}
$user_name=$_SESSION['user_name'];

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
            <li class="list-inline-item"><a role="button" class="btn btn-info btn-lg"  href='admin_menu_s.php'>Добавить студента</a></li>
            <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg"  href='admin_menu_l.php'>Добавить преподователя</a></li>
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
        
        <h4>Регистрация нового студента</h4>

        <div class='row'>

            <div class='col-md-6'>
                <form method="post" action="add_stud.php">

                <label>Имя</label>
                <input type="text" maxlength='10' required class="form-control" name="name"  placeholder="Имя">

                <label>Фамилия</label>
                <input type="text" maxlength='10' required class="form-control" name="name_second"  placeholder="Фамилия">

                <label>Отчество</label>
                <input type="text" maxlength='10' required class="form-control" name="name_patronic"  placeholder="Отчество">
                
                <label>Факультет</label>
                <input type="text" maxlength='50' required class="form-control" name="faculty"  placeholder="Факультет">

                <label>Курс</label>
                <input type="number" min=0 max=6 required class="form-control" name="kurs"  placeholder="Курс">

                <label>Группа</label>
                <input type="text" maxlength='4' required class="form-control" name="class"  placeholder="Группа">

                <label>Подгруппа</label>
                <input type="number" min=1 max=2 required class="form-control" name="subclass"  placeholder="Подгруппа">

                <label>Статус</label>
                <input type="text" maxlength='10' required class="form-control" name="status"  placeholder="Статус">

                <label>Логин</label>
                <input type="text" maxlength='20' required class="form-control" name="login"  placeholder="Логин">

                <label>Пароль</label>
                <input type="text" maxlength='20' required class="form-control" name="password"  placeholder="Пароль">

                <hr>
                
                    <button type="submit" class="btn btn-primary">Зарегистрировать</button>
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
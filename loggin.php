<?php
session_start();
unset($_SESSION['user_name']);
unset($_SESSION['Id']);
unset($_SESSION['type']);
?>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class='container-fluid'>
        <h2 align='center'>Аттестационная ведомость онлайн</h2>
        <hr>
        <br>

        <div class='row'>

            <div class='col-md-4'>
            </div>
            <div class='col-md-4'>
                <h4>Авторизация</h4>
                <hr>

                <form method="post" action="identify_user.php">
                    <div class="form-group">
                        <label for="login">Логин</label>
                        <input class="form-control" name="login" aria-describedby="emailHelp" placeholder="Логин" value='Kate@student'>
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" class="form-control" name="password" placeholder="Пароль" value='12345'>
                    </div>

                    <button type="submit" class="btn btn-primary">Вход</button>
                </form>
            </div>

            <div class='col-md-4'>
            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
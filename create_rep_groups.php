<?php
$faculty=$_POST['faculty'];
$kurs=$_POST['kurs'];
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
        <ul class='list-inline list-unstyled'>
        <li class="list-inline-item"><a role="button" class="btn btn-info btn-lg" title='Создание новой ведомости' href='create_rep_faculty.php'>Добавление</a></li>
            <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg" title='Редактирование уже существующей ведомости' href='edit_exist_report.html'>Редактирование</a></li>
            <li class="list-inline-item"><a role="button" class="btn btn-link btn-lg" title='Просмотр существующих ведомостей'>Просмотр</a></li>
        </ul>
        <hr>

        <h4>Настройка ведомости</h4>
        <hr>
        <div class='row'>

            <div class='col-md-12'>

                <div class='row'>

                    <div class='col-md-1'>
                        <label>Дисциплина</label>
                    </div>
                    <div class='col-md-2'>
                        <!-- вставка  дисциплины -->
                        <label><b id='subject'>Математика</b></label>
                    </div>


                    <div class='col-md-2'> <label for="report_number">Номер аттестации</label>
                    </div>
                    <div class='col-md-1'>

                        <select class="form-control" id="report_number">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>

                    </div>

                    <div class='col-md-1'>
                        <label for="date">Дата</label>
                    </div>
                    <div class='col-md-2'>
                        <input type="date" class="form-control" id="date">
                    </div>
                </div>

                <hr>
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

                    <div class='col-md-1'>
                        <label>Группа</label>
                    </div>
                    <div class='col-md-1'>
                        <!-- вставка группы -->
                        <label><b id='group'>1.1</b></label>
                    </div>
                </div>

                <hr>

                </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
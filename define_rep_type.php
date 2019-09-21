<?php
session_start();
$_SESSION['faculty']=$_POST['faculty'];
$_SESSION['kurs']=$_POST['kurs'];
$_SESSION['group']=$_POST['group'];
$_SESSION['sub_group']=$_POST['sub_group'];
$_SESSION['subject']=$_POST['subject'];

$type=$_POST['att_type'];

    if($type=='Аттестация')
    {
        header('Location: http://localhost/Educational_practice/edit_clear_rep_att.php');
    }
    else if($type=='Экзамен')
    {
        header('Location: http://localhost/Educational_practice/edit_clear_rep_exam.php');
    }
    else if($type=='Зачёт')
    {
        header('Location: http://localhost/Educational_practice/edit_clear_rep_credit.php');
    }
    else if($type=='Зачёт с оценкой')
    {
        header('Location: http://localhost/Educational_practice/edit_clear_rep_credit_mark.php');
    }

?>
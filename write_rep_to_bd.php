<?php
$att_num = $_POST['report_number'];
$subj_name = $_POST['subject'];
$att_date = $_POST['date'];
$students_count = $_POST['students_count'];
$user_name=$_POST['user_name'];

require_once 'login.php';
$conn = new mysqli($hn, $user, $password, $database);
if ($conn->connect_error) die("Fatal Error");

$query = "SELECT Id FROM Subjects WHERE Name='$subj_name'";

$result = $conn->query($query);
if (!$result) die($conn->error);

$rows = $result->num_rows;
$row = $result->fetch_array(MYSQLI_ASSOC);
$subj_id = htmlspecialchars($row['Id']);

$query = "SELECT Id FROM Lecturers WHERE Login='$user_name'";
$result = $conn->query($query);
if (!$result) die($conn->error);
$row = $result->fetch_array(MYSQLI_ASSOC);
$lecturerId = htmlspecialchars($row['Id']);


$query = "INSERT INTO Attestations VALUES(NULL,$att_num,$lecturerId,$subj_id,'$att_date')";
$result = $conn->query($query);
$att_insertId = $conn->insert_id;

for ($j = 0; $j < $students_count; ++$j) {

    $post_id_name = 'input_student_' . "$j";
    $stud_id = $_POST["$post_id_name"];

    $post_mark_name = 'input_mark_' . "$j";
    $stud_mark = $_POST["$post_mark_name"];

    $query = "INSERT INTO student_attestation VALUES(NULL,$stud_id,$att_insertId,$stud_mark)";
    $result = $conn->query($query);
}
 ?>
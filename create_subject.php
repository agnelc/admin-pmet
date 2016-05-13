<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in();  ?>
<?php

require_once("includes/connection.php");
require_once("includes/functions.php");

$errors = array();

//Form Validation
$required_fields = array('menu_name', 'position', 'visible');
foreach ($required_fields as $fieldname) {
    if (!isset($_POST['$fieldname']) || empty($_POST['$fieldname'])) {
        $errors[] = '$fieldname';
    }
}

$fields_with_lengths = array('menu_name' => 30);
foreach ($fields_with_lengths as $fieldname => $maxlength) {
    if (strlen(trim(mysql_prep($_POST['$fieldname']))) > $maxlength) {
        $errors[] = '$fieldname';
    }
}


if (!empty($errors)) {
    redirect_to("new_subject.php");
}

$menu_name = mysql_prep($_POST['menu_name']);
$position = mysql_prep($_POST['position']);
$visible = mysql_prep($_POST['visible']);

$query = "INSERT INTO subjects(menu_name,position,visible)"
        . "VALUES ('{$menu_name}','{$position}','{$visible}')";
$result = mysqli_query($connection, $query);
if ($result) {
    header("Location:content.php");
    exit();
} else {
    echo"<p>Subject creation failed.</p>";
    echo"<p>" . mysqli_error($connection) . "</p>";
}

if (isset($connection)) {
    mysqli_close($connection);
}
?>

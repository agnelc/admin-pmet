<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in();  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
global $connection;
if (intval($_GET['subj']) == 0) {
    redirect_to("content.php");
}

$id = mysql_prep(intval($_GET['subj']));

if ($subject = get_subject_by_id($id)) {
    $query = "DELETE FROM subjects WHERE id = {$id} LIMIT 1";
    $result = mysqli_query($connection, $query);
    if (mysqli_affected_rows($connection) == 1) {
        redirect_to("content.php");
    } else {
        //Deletion Failed
       
        echo "<p>Subject deletion failed.</p>";
        echo "<p>" . mysqli_error() . "</p>";
        echo "<a href=\"content.php\">Return to main page</a>";
    }
} else {
    //subject didn't exist in database
    redirect_to("content.php");
}
?>
<?php mysqli_close($connection); ?>
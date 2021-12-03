<?php
// 2a) Check if valid user is logged in.
if($_SESSION["userID"]=='786' || $_SESSION["userID"]=='793' || $_SESSION["userID"]=='435'){

} else {
    header("Location: index.php?menu=login");
}
// 2b) Check if session is expired.
if($_SESSION["login_time"]+$login_session_duration<time()) {
    header("Location: index.php?menu=sessionexpired");
}
?>

<!-- 2c) Put the upload form here-->
<div class="container">
        <form method="post" enctype="multipart/form-data">
            <input type="file" class="form-control" accept="application/pdf" name="fileToUpload" id="fileToUpload">
            <input type="submit" class="btn btn-primary"  value="Upload File" name="submit">
        </form>


    <?php

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        // 2d) Put the PHP-Code for handling the file here
        // hint: Define useful variables.
        // e.g. the target directory, the accepted file type, the file itself, etc.
        $target_dir = "uploads/";
        $uploadError = FALSE;
        $target_file = $target_dir.basename($_SESSION["userID"])."_".basename($_FILES["fileToUpload"]["name"]);


        // Check if the file is of the accepted file type
        if ($_FILES["fileToUpload"]["type"] != "application/pdf"){
            echo '<p class="red">Sorry, only PDF-Files can be acceptet</p>';
            $uploadError = TRUE;
        }

        // Check if the file size is below the maximum limit
        if ($_FILES["fileToUpload"]["size"]>15000000){
            echo '<p class="red">Sorry, only Files below 15MB can be acceptet</p>';
            $uploadError = TRUE;
        }

        // Check if the file already exists
        if (file_exists($target_file)) {
            echo '<p class="red">Sorry, the file already exists</p>';
            $uploadError = TRUE;
        }

        // If everything is OK, upload the file
        if (!$uploadError) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file)) {
                echo '<p class="green">The file '.basename($_FILES["fileToUpload"]["name"]).' has been uploaded<p>';
            }
        }
    }
    ?>


</div>
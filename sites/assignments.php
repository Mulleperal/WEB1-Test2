<?php
// 3a) Check if valid lecturer is logged in.
if($_SESSION["userID"]=='435'){

} else {
   // Bemerkung: In der Angabe ist nicht weiter beschrieben, was passieren soll.
   // Deshalb wurden Studenten zum Uploadmenu umgeleitet und nicht eingeloggte Gäste zum Login-Bildschirm
   if($_SESSION["userID"]=='786' || $_SESSION["userID"]=='793') {
      header("Location: index.php?menu=upload");
   } else {
      header("Location: index.php?menu=login");
   }
}
// 3b) Check if session is expired.
if($_SESSION["login_time"]+$login_session_duration<time()) {
   header("Location: index.php?menu=sessionexpired");
}
?>

<div class="container">
   <div class="row">
      <div class="col-sm">
         <a href="index.php?menu=download"><img class="imgcenter" src="./res/img/download.png" alt="Download image"></a>
      </div>
      <div class="col-9 assignments">
         <?php
            $uploadDir = "uploads/";
            // 3c) Open the uploads directory using an appropriate function, and read its contents
            if (file_exists($uploadDir)) {
               $files = scandir($uploadDir);

            // If no files have been uploaded yet, display "No files uploaded yet." in red font
               if (count($files) == 2) {
                  echo '<p class="red">No files uploaded yet.</p>';
               }

            // Link each uploaded file. Hint: keep in mind to use the correct path!
               for ($i = 2; isset($files[$i]); $i++) {
                  echo '<div>'.$files[$i].' ->&nbsp;';
                  echo '<a href="'.'uploads/'.$files[$i].'"download >Download </a></div>';
               }
            }

         ?>
      </div>
   </div>
</div>
<?php

 ob_clean();
 echo '<table class="table table-bordered"><thead>';
 echo '<tr>';
 echo '<th>Date</th>';
 foreach (json_decode($_REQUEST['table_title']) as $title) {
   echo '<th>' . $title . '</th>';
 }
 echo '</tr></thead><tbody>';


 foreach (json_decode($_REQUEST['table_data']) as $data) {
   echo '<tr>';
   $is_data = true;
   foreach ($data as $value) {
     if ($is_data) {
       echo '<td>' . date("d-m-Y", $value / 1000) . '</td>';
     }
     else {
       echo '<td>' . $value . '</td>';
     }
     $is_data = false;
   }
   echo '</tr>';
 }
 echo '</tbody></table>';
 exit;
 
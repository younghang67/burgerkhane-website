<?php

$conn = mysqli_connect('localhost', 'rusan', 'rusan123', 'bugerKhane');

if (!$conn) {
    echo 'connection error: ' . mysqli_connect_error();
}
//connect to databes no.1
// $conn = mysqli_connect('localhost', 'rusan', 'rusan123', 'bugerKhane'); //(localhost, user account, userpassword, table from database)

// //checking connection
// if (!$conn) {
//     echo ' connection error : ' . mysqli_connect_error();
// }

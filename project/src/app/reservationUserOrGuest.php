<?php if (empty($_SESSION['logged_id'])) {
    header('Location: /src/html/reservationBook.php');
} else {
    header('Location: /src/html/reservationLoginOrGuest.php');
}
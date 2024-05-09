<?php 
require_once './components/header.php';

echo getHeader();
?>

<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Superstar Rental Car</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Superstar Rent Car</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./fleet.php">Fleet</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="./login.php" class="nav-link"> <button class="btn btn-primary"
                                    type="submit">Login</button></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="text-content">
            <h1 class="text-center" style="margin-top: 100px;">Dashboard</h1>
        </div>
    </div>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="row">
            <div class="col p-3">
                <div style="height:150px; width:250px; border-radius:15px; 	background-color:rgba(25, 135, 84, 0.5);">
                    <div class="text-content d-flex justify-content-center">
                        <h3 class="h4" style="padding-top: 15px;">Manage Cars</h3>
                    </div>
                    <img src="../img/carIcon.svg" alt="Car Icon"
                        style="height: 40px; width:40px; position:relative; left:50%; transform:translate(-50%);">
                    <a href="./manageCars.php"> <img src="../img/arrowDown.svg" alt="Arrow Down" style="width:30px;
                    position:relative; top:50px; left:65px;" ;></a>
                </div>
                <div class="mt-4">
                    <div
                        style="height:150px; width:250px; border-radius:15px; 	background-color:rgba(25, 135, 84, 0.5);">
                        <div class="text-content d-flex justify-content-center">
                            <h3 class="h4" style="padding-top: 15px;">Users</h3>
                        </div>
                        <img src="../img/users.svg" alt="Car Icon"
                            style="height: 40px; width:40px; position:relative; left:50%; transform:translate(-50%);">
                        <a href=""> <img src="../img/arrowDown.svg" alt="Arrow Down" style="width:30px;
                        position:relative; top:50px; left:65px;" ;></a>
                    </div>
                </div>
            </div>
            <div class="col p-3">
                <div style="height:150px; width:250px; border-radius:15px; 	background-color:rgba(25, 135, 84, 0.5);">
                    <div class="text-content d-flex justify-content-center">
                        <h3 class="h4" style="padding-top: 15px;">Book a Reservation</h3>
                    </div>
                    <img src="../img/reservation.svg" alt="Car Icon"
                        style="height: 40px; width:40px; position:relative; left:50%; transform:translate(-50%);">
                    <a href=""> <img src="../img/arrowDown.svg" alt="Arrow Down" style="width:30px;
                    position:relative; top:50px; left:65px;" ;></a>
                </div>
                <div class="mt-4">
                    <div
                        style="height:150px; width:250px; border-radius:15px; 	background-color:rgba(25, 135, 84, 0.5);">
                        <div class="text-content d-flex justify-content-center">
                            <h3 class="h4" style="padding-top: 15px;">Reservations</h3>
                        </div>
                        <img src="../img/grid.svg" alt="Car Icon"
                            style="height: 40px; width:40px; position:relative; left:50%; transform:translate(-50%); margin-top:5px;">
                        <a href=""> <img src="../img/arrowDown.svg" alt="Arrow Down" style="width:30px;
                        position:relative; top:50px; left:65px;" ;></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
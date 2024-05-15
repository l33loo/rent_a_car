<?php 
require_once '../components/header.php';

echo getHeader();
?>

<body>
    <?php include '../components/navbar.inc.php'; ?>
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
                        <h3 class="h4" style="padding-top: 15px;">Manage Vehicles</h3>
                    </div>
                    <img src="../../img/carIcon.svg" alt="Car Icon"
                        style="height: 40px; width:40px; position:relative; left:50%; transform:translate(-50%);">
                    <a href="./vehicles.php"> <img src="../../img/arrowDown.svg" alt="Arrow Down" style="width:30px;
                    position:relative; top:50px; left:65px;" ;></a>
                </div>
                <div class="mt-4">
                    <div
                        style="height:150px; width:250px; border-radius:15px; 	background-color:rgba(25, 135, 84, 0.5);">
                        <div class="text-content d-flex justify-content-center">
                            <h3 class="h4" style="padding-top: 15px;">Users</h3>
                        </div>
                        <img src="../../img/users.svg" alt="Car Icon"
                            style="height: 40px; width:40px; position:relative; left:50%; transform:translate(-50%);">
                        <a href="./users.php"> <img src="../../img/arrowDown.svg" alt="Arrow Down" style="width:30px;
                        position:relative; top:50px; left:65px;" ;></a>
                    </div>
                </div>
            </div>
            <div class="col p-3">
                <div style="height:150px; width:250px; border-radius:15px; 	background-color:rgba(25, 135, 84, 0.5);">
                    <div class="text-content d-flex justify-content-center">
                        <h3 class="h4" style="padding-top: 15px;">Book a Reservation</h3>
                    </div>
                    <img src="../../img/reservation.svg" alt="Car Icon"
                        style="height: 40px; width:40px; position:relative; left:50%; transform:translate(-50%);">
                    <a href=""> <img src="../../img/arrowDown.svg" alt="Arrow Down" style="width:30px;
                    position:relative; top:50px; left:65px;" ;></a>
                </div>
                <div class="mt-4">
                    <div
                        style="height:150px; width:250px; border-radius:15px; 	background-color:rgba(25, 135, 84, 0.5);">
                        <div class="text-content d-flex justify-content-center">
                            <h3 class="h4" style="padding-top: 15px;">Reservations</h3>
                        </div>
                        <img src="../../img/grid.svg" alt="Car Icon"
                            style="height: 40px; width:40px; position:relative; left:50%; transform:translate(-50%); margin-top:5px;">
                        <a href=""> <img src="../../img/arrowDown.svg" alt="Arrow Down" style="width:30px;
                        position:relative; top:50px; left:65px;" ;></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../components/footer.inc.php'; ?>
</body>

</html>
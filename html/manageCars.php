<?php
require_once '../html/components/header.php';

echo getHeader();?>

<!DOCTYPE html>
<html lang="en">
<style>
.text-content {
    position: absolute;
    color: white;
}
</style>

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
            <h1 style="margin-top: 150px; margin-bottom:50px;">Manage Cars</h1>
        </div>
    </div>
    <div class="container">
        <table id="my_table_id" data-url="data/url.json" data-id-field="id"
            data-editable-emptytext="Default empty text." data-editable-url="/my/editable/update/path">
            <thead>
                <tr>
                    <th class="col-md-1" data-field="id" data-sortable="true" data-align="center">#</th>
                    <th class="col-md-4" data-field="name" data-editable="true">Name</th>
                    <th class="col-md-7" data-field="description" data-editable="true"
                        data-editable-emptytext="Custom empty text.">Description</th>
                </tr>
            </thead>
        </table>
    </div>
    <script type="text/javascript">
    </script>
</body>

</html>
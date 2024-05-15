<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/html/admin/dashboard.php">Superstar Rental Car</a>
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
                        <a class="nav-link active" aria-current="page" href="/html/admin/dashboard.php">
                            ADMIN Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./fleet.php">
                            ADMIN Fleet
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./about.php">
                            ADMIN About
                        </a>
                    </li>
                    <li class="nav-item">
                        <?php if (!empty($_SESSION['logged_id']) && $_SESSION['logged_id'] === true) { ?>
                            <a class="btn btn-secondary" href="../app/logout.php" class="nav-link">
                                Logout
                            </a>
                        <?php } else { ?>
                            <a class="btn btn-primary" href="../login.php" class="nav-link">
                                Login
                            </a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/src/html/admin/dashboard.php">Superstar Rental Car</a>
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
                <?php if (!empty($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
                    include 'navbar/navbarAdmin.inc.php';
                } else if (!empty($_SESSION['logged_id'])) {
                    include 'navbar/navbarUser.inc.php';
                } else {
                    include 'navbar/navbarGuest.inc.php';
                } ?>
            </div>
        </div>
    </div>
</nav>
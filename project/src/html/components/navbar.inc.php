<?php $isAdmin = !empty($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true;
$color = $isAdmin ? 'warning' : 'dark' ?>
<nav class="navbar navbar-<?php echo $color ?> bg-<?php echo $color ?>">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo $isAdmin ? '/src/html/admin/dashboard.php' : '/' ?>">Superstar Rent-A-Car</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-<?php echo $color ?>" tabindex="-1" id="offcanvasDarkNavbar"
            aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Superstar Rent-A-Car</h5>
                <button type="button" class="btn-close <?php echo $isAdmin ? 'btn-close-dark' : 'btn-close-white' ?>" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <?php if ($isAdmin) {
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

<div class="offcanvas-body">
    <div><strong>Welcome back, <?php echo $_SESSION['name']; ?>!</strong></div>
    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 mt-4">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="">
                Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/src/html/userView.php">
                My Account
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/src/html/reservations.php">
                My Reservations
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/src/html/about.php">
                About
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/src/html/fleet.php">
                Fleet
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="btn btn-warning" href="/src/app/logout.php">
                Logout
            </a>
        </li>
    </ul>
</div>
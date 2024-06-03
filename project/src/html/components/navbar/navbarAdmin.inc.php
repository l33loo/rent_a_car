<div class="offcanvas-body">
    <div><strong>Welcome back, <?php echo $_SESSION['name']; ?>!</strong></div>
    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 mt-4">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/src/html/admin/dashboard.php">
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/src/html/admin/vehicles.php">
                Manage Vehicles
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/src/html/admin/locations.php">
                Manage Locations
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/src/html/admin/users.php">
                Manage Users
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/src/html/admin/reservations.php">
                Manage Reservations
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="btn btn-dark" href="/src/app/logout.php">
                Logout
            </a>
        </li>
    </ul>
</div>
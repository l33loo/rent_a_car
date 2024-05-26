<div class="offcanvas-body">
    <div>Welcome back, <?php echo $_SESSION['name']; ?>!</div>
    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/src/html/admin/dashboard.php">
                Dashboard
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="./fleet.php">
                ADMIN Fleet
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./about.php">
                ADMIN About
            </a>
        </li> -->
        <li class="nav-item">
            <a class="btn btn-secondary" href="/app/logout.php" class="nav-link">
                Logout
            </a>
        </li>
    </ul>
</div>
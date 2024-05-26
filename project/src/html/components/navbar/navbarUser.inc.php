
<div class="offcanvas-body">
    <div>Welcome back, <?php echo $_SESSION['name']; ?>!</div>
    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/index.php">
                Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/src/html/fleet.php">
                Fleet
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/src/html/about.php">
                About
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/src/html/userView.php">
                My Account
            </a>
        </li>
        <li class="nav-item">
            <a class="btn btn-secondary" href="/src/app/logout.php" class="nav-link">
                Logout
            </a>
        </li>
    </ul>
</div>
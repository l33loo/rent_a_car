<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/inc/sessionUser.inc.php';

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
    <div class="container">
        <h1 class="text-center mb-5" style="margin-top: 100px;">Sign Up</h1>
        <form action="/src/app/signup.php" method="post">
            <div class="row mb-3">
                <div class="col">
                    <img src="/img/profile.svg" alt="" style="height: 20px; width:20px; margin-bottom:10px;">
                    <label for="name">
                        Name:
                    </label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="col">
                    <img src="/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                    <label for="email">
                        Email:
                    </label>
                    <input type="email" class="form-control" name="email">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <img src="/img/password.svg" alt="" style="height: 20px; width:20px; margin-bottom:10px;">
                    <label for="password">
                        Password:
                    </label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="col">
                    <img src="/img/password.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                    <label for="confirmPassword">
                        Confirm password:
                    </label>
                    <input type="password" class="form-control" name="confirmPassword">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <img src="/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                    <label for="phone">
                        Phone:
                    </label>
                    <input type="text" class="form-control" name="phone">
                </div>
                <div class="col">
                    <img src="/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                    <label for="dateOfBirth">
                        Birthdate:
                    </label>
                    <input type="date" class="form-control" name="dateOfBirth">
                </div>
            </div>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/formAddress.inc.php'; ?>
            <div class="d-flex justify-content-center">
                <input
                    type="submit"
                    class="btn btn-outline-success"
                    name="signup"
                    value="Sign Up"
                />
            </div>
        </form>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
    <script type="text/javascript">
    </script>
</body>

</html>
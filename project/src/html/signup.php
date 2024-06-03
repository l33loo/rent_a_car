<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/inc/sessionUser.inc.php';

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
    <div class="container">
        <h1 class="text-center mb-5" style="margin-top: 100px;">Sign Up</h1>
        <?php $errorMsg = (empty($_SESSION['errors']) || empty($_SESSION['errors']['signupPage'])) ? null : $_SESSION['errors']['signupPage'];
        if (!empty($errorMsg)) { ?>
            <div class="alert alert-danger">
                <?php echo $errorMsg;
                unset($_SESSION['errors']['signupPage']); ?>
            </div>
        <?php } ?>
        <form action="/src/app/signup.php" method="post">
            <div class="row mb-3">
                <div class="col">
                    <img src="/src/img/profile.svg" alt="" style="height: 20px; width:20px; margin-bottom:10px;">
                    <label for="name">
                        Name:
                    </label>
                    <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['name'])) { ?>
                    <div class="text-danger">
                        <small>
                            <?php echo $_SESSION['errors']['name'];
                            unset($_SESSION['errors']['name']); ?>
                        </small>
                    </div>
                <?php } ?>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="col">
                    <img src="/src/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                    <label for="email">
                        Email:
                    </label>
                    <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['email'])) { ?>
                        <div class="text-danger">
                            <small>
                                <?php echo $_SESSION['errors']['email'];
                                unset($_SESSION['errors']['email']); ?>
                            </small>
                        </div>
                    <?php } ?>
                    <input type="email" class="form-control" name="email">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <img src="/src/img/password.svg" alt="" style="height: 20px; width:20px; margin-bottom:10px;">
                    <label for="password">
                        Password:
                    </label>
                    <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['password'])) { ?>
                        <div class="text-danger">
                            <small>
                                <?php echo $_SESSION['errors']['password'];
                                unset($_SESSION['errors']['password']); ?>
                            </small>
                        </div>
                    <?php } ?>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="col">
                    <img src="/src/img/password.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                    <label for="confirmPassword">
                        Confirm password:
                    </label>
                    <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['confirmPassword'])) { ?>
                        <div class="text-danger">
                            <small>
                                <?php echo $_SESSION['errors']['confirmPassword'];
                                unset($_SESSION['errors']['confirmPassword']); ?>
                            </small>
                        </div>
                    <?php } ?>
                    <input type="password" class="form-control" name="confirmPassword">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <img src="/src/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                    <label for="phone">
                        Phone:
                    </label>
                    <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['phone'])) { ?>
                        <div class="text-danger">
                            <small>
                                <?php echo $_SESSION['errors']['phone'];
                                unset($_SESSION['errors']['phone']); ?>
                            </small>
                        </div>
                    <?php } ?>
                    <input type="text" class="form-control" name="phone">
                </div>
                <div class="col">
                    <img src="/src/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                    <label for="dateOfBirth">
                        Birthdate:
                    </label>
                    <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['dateOfBirth'])) { ?>
                        <div class="text-danger">
                            <small>
                                <?php echo $_SESSION['errors']['dateOfBirth'];
                                unset($_SESSION['errors']['dateOfBirth']); ?>
                            </small>
                        </div>
                    <?php } ?>
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
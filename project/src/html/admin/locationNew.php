<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/inc/islands.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/app/admin/inc/session.inc.php';

echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/navbar.inc.php'; ?>
    <div class="container">
        <h1 class="text-center mb-5" style="margin-top: 100px;">Add New Location</h1>
        <?php $errorMsg = (empty($_SESSION['errors']) || empty($_SESSION['errors']['adminLocNewPage'])) ? null : $_SESSION['errors']['adminLocNewPage'];
        if (!empty($errorMsg)) { ?>
            <div class="alert alert-danger">
                <?php echo $errorMsg;
                unset($_SESSION['errors']['adminLocNewPage']); ?>
            </div>
        <?php } ?>
        <form action="/src/app/admin/locationNew.php" method="post">
            <div class="row mb-3">
                <div class="col">
                    <img src="/src/img/profile.svg" alt="" style="height: 20px; width:20px; margin-bottom:10px;">
                    <label for="name">
                        Location Name:
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
                        Select Island:
                    </label>
                    <?php if (!empty($_SESSION['errors']) && !empty($_SESSION['errors']['islandId'])) { ?>
                        <div class="text-danger">
                            <small>
                                <?php echo $_SESSION['errors']['islandId'];
                                unset($_SESSION['errors']['islandId']); ?>
                            </small>
                        </div>
                    <?php } ?>
                    <select class="form-select" name="islandId">
                        <?php foreach($islands as $island) { ?>
                            <option value="<?php echo $island->getId(); ?>">
                                <?php echo $island->getName(); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/formAddress.inc.php'; ?>
            <div class="d-flex justify-content-center">
                <input
                    type="submit"
                    class="btn btn-primary"
                    name="locationNew"
                    value="Add Location"
                />
            </div>
        </form>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/footer.inc.php'; ?>
    <script type="text/javascript">
    </script>
</body>

</html>
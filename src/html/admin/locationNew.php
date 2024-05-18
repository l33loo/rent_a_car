<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/inc/islands.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';


echo getHeader();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/navbar.inc.php'; ?>
    <div class="container">
        <h1 class="text-center mb-5" style="margin-top: 100px;">Add New Location</h1>
        <form action="/app/admin/locationNew.php" method="post">
            <div class="row mb-3">
                <div class="col">
                    <img src="/img/profile.svg" alt="" style="height: 20px; width:20px; margin-bottom:10px;">
                    <label for="name">
                        Location Name:
                    </label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="col">
                    <img src="/img/email.svg" alt="" style="height: 20px; width:20px; margin-bottom:5px;">
                    <label for="email">
                        Select Fleet:
                    </label>
                    <select class="form-control" name="islandId">
                        <?php foreach($islands as $island) { ?>
                            <option value="<?php echo $island->getId(); ?>">
                                <?php echo $island->getName(); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/formAddress.inc.php'; ?>
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
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/html/components/footer.inc.php'; ?>
    <script type="text/javascript">
    </script>
</body>

</html>
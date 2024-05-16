<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/users.inc.php';

echo getHeader();
?>

<body>
    <?php include '../components/navbar.inc.php'; ?>
    <div class="container">
        <div class="text-content">
            <h1 style="margin-top: 150px; margin-bottom:50px;">Manage Users</h1>
        </div>
    </div>
    <div class="container">
        <table class="table table-bordered" id="my_table_id" data-url="data/url.json" data-id-field="id"
            data-editable-emptytext="Default empty text." data-editable-url="/my/editable/update/path">
            <thead>
                <tr>
                    <th class="col" data-field="id" data-sortable="true" data-align="center">
                        ID
                    </th>
                    <th
                        class="col"
                        data-field="description"
                        data-editable="true"
                        data-editable-emptytext="Custom empty text."
                    >
                        Name
                    </th>
                    <th class="col" data-field="name" data-editable="true">
                        Email
                    </th>
                    <th
                        class="col"
                        data-field="description"
                        data-editable="true"
                        data-editable-emptytext="Custom empty text."
                    >
                        Date of birth
                    </th>
                    <!-- TODO: get string of address??
                    <th
                        class="col"
                        data-field="description"
                        data-editable="true"
                        data-editable-emptytext="Custom empty text."
                    >
                        Address
                    </th> -->
                    <th
                        class="col"
                        data-field="description"
                        data-editable="true"
                        data-editable-emptytext="Custom empty text."
                    >
                        Phone
                    </th>
                    <th
                        class="col"
                        data-field="description"
                        data-editable="true"
                        data-editable-emptytext="Custom empty text."
                    >
                        Is Admin
                    </th>
                    <th
                        class="col"
                        data-field="description"
                        data-editable="true"
                        data-editable-emptytext="Custom empty text."
                    >
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) {
                    $userId = $user->getId();
                    $userIsArchived = $user->getIsArchived();
                ?>
                    <tr <?php if ($userIsArchived) {
                        echo 'class="table-active"';
                    } ?>>
                        <th><?php echo $userId; ?></th>
                        <td><?php echo $user->getName(); ?></td>
                        <td><?php echo $user->getEmail(); ?></td>
                        <td><?php echo $user->getDateOfBirth(); ?></td>
                        <!-- <td><?php // echo $user->getAddress(); ?></td> -->
                        <td><?php echo $user->getPhone(); ?></td>
                        <td><?php echo $user->getIsAdmin() ? 'Yes' : 'No'; ?></td>
                        <td class="d-flex flex-wrap justify-content-evenly">
                            <a href="user.php?id=<?php echo $user->getId(); ?>" class="btn btn-primary">View</a>
                            <a href="" class="btn btn-secondary">Edit</a>
                            <?php if ($userIsArchived) { ?>
                                <form action="" method="POST">
                                    <input type="submit" name="unarchiveUser" class="btn btn-success" value="Unarchive" />
                                    <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
                                    <?php if (isset($_POST['unarchiveUser']) && !empty($_POST['userId']) && $_POST['userId'] === "$userId") {
                                        $user->setIsArchived(false)->save();
                                    }
                                    ?>
                                </form>
                            <?php } else { ?>
                                <form action="" method="POST">
                                    <input type="submit" name="archiveUser" class="btn btn-danger" value="Archive" />
                                    <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
                                    <?php if (isset($_POST['archiveUser']) && !empty($_POST['userId']) && $_POST['userId'] === "$userId") {
                                        $user->setIsArchived(true)->save();
                                    }
                                    ?>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php include '../components/footer.inc.php'; ?>
</body>

</html>
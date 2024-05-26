<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/html/components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/session.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/RentACar/User.php';

use RentACar\User;

// TODO: error handling
$users = User::search([], 'user');

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
                    <th
                        class="col"
                        data-field="description"
                        data-editable="true"
                        data-editable-emptytext="Custom empty text."
                    >
                        Address
                    </th>
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
                <!-- TODO: error handling -->
                <?php foreach ($users as $user) {
                    $user->loadRelation('address');
                    $address = $user->getAddress();
                    $address->loadRelation('country');
                    $userId = $user->getId();
                    $userIsArchived = $user->getIsArchived();
                ?>
                <tr
                    <?php if ($userIsArchived) {
                        echo 'class="table-active"';
                    } ?>
                >
                        <th><?php echo $userId; ?></th>
                        <td><?php echo $user->getName(); ?></td>
                        <td><?php echo $user->getEmail(); ?></td>
                        <td><?php echo $user->getDateOfBirth(); ?></td>
                        <td><?php echo $address->getAddressToString(); ?></td>
                        <td><?php echo $user->getPhone(); ?></td>
                        <td><?php echo $user->getIsAdmin() ? 'Yes' : 'No'; ?></td>
                        <td class="d-flex flex-wrap justify-content-evenly">
                            <a href="/html/admin/user.php?id=<?php echo $userId; ?>" class="btn btn-primary">View</a>
                            <a href="/html/admin/userEdit.php?id=<?php echo $userId; ?>" class="btn btn-secondary">Edit</a>
                            <?php if ($userIsArchived) { ?>
                                <form action="/app/admin/userEdit.php" method="POST">
                                    <input type="submit" name="unarchiveUser" class="btn btn-success" value="Unarchive" />
                                    <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
                                </form>
                            <?php } else { ?>
                                <form action="/app/admin/userEdit.php" method="POST">
                                    <input type="submit" name="archiveUser" class="btn btn-danger" value="Archive" />
                                    <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
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
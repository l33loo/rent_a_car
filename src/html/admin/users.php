<?php
require_once '../components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/users.inc.php';

echo getHeader();?>

<body>
    <?php include '../components/navbar.inc.php'; ?>
    <div class="container">
        <div class="text-content">
            <h1 style="margin-top: 150px; margin-bottom:50px;">Manage Users</h1>
        </div>
    </div>
    <div class="container">
        <table id="my_table_id" data-url="data/url.json" data-id-field="id"
            data-editable-emptytext="Default empty text." data-editable-url="/my/editable/update/path">
            <thead>
                <?php /*
                    ?string $name = null,
                    ?string $email = null,
                    ?string $dateOfBirth = null,
                    // ?string $address = null,
                    ?string $phone = null,
                    bool $isArchived = false,
                    ?string $password = null,
                    bool $isAdmin = false,
                    ?int $address_id = 1,
                    ?int $id = null
                */ ?>
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
                    <!-- <th
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
                        Is Archived
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
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user->getId(); ?></td>
                        <td><?php echo $user->getName(); ?></td>
                        <td><?php echo $user->getEmail(); ?></td>
                        <td><?php echo $user->getDateOfBirth(); ?></td>
                        <!-- <td><?php // echo $user->getAddress(); ?></td> -->
                        <td><?php echo $user->getPhone(); ?></td>
                        <td><?php echo $user->getIsArchived(); ?></td>
                        <td><?php echo $user->getIsAdmin(); ?></td>
                        <td>
                            <a href="user.php?id=<?php echo $user->getId(); ?>" class="btn btn-primary">View</a>
                            <a href="" class="btn btn-secondary">Edit</a>
                            <a href="" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php include '../components/footer.inc.php'; ?>
</body>

</html>
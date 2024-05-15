<?php
require_once '../components/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/admin/inc/reservations.inc.php';

session_start();

echo getHeader();
?>

<body>
    <?php include '../components/navbar.inc.php'; ?>
    <div class="container">
        <div class="text-content">
            <h1 style="margin-top: 150px; margin-bottom:50px;">Manage Reservations</h1>
        </div>
    </div>
    <div class="container">
        <table id="my_table_id" data-url="data/url.json" data-id-field="id"
            data-editable-emptytext="Default empty text." data-editable-url="/my/editable/update/path">
            <thead>
                <?php /*
                    protected int $id;
                    protected fleets\Category $category;
                    protected accounts\Customer $customer;
                    protected Status $status;
                    protected locality\Location $pickupLocation;
                    protected locality\Location $dropoffLocation;
                    // TODO: use Carbon type
                    protected string $pickupDate;
                    // TODO: use Carbon type
                    protected string $dropoffDate;
                    // TODO: use Carbon type
                    protected string $pickupTime;
                    // TODO: use Carbon type
                    protected string $dropoffTime;
                    protected fleets\Vehicle $vehicle;
                    protected accounts\User $reservedBy;
                    // TODO: use Carbon type
                    protected string $reservedDate;
                    // TODO: Update UML to reflect this
                    protected array $revisions;
                    // TODO: use Carbon type
                    protected string $dateReturned;
                    // TODO: use Carbon type
                    protected string $timeReturned;
                    protected locality\Location $returnedLocation;
                    protected accounts\User $collectedBy;
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
                <?php foreach ($reservations as $reservation) { ?>
                    <tr>
                        <td><?php echo $reservation->getId(); ?></td>
                        <td><?php echo $reservation->getName(); ?></td>
                        <td><?php echo $reservation->getEmail(); ?></td>
                        <td><?php echo $reservation->getDateOfBirth(); ?></td>
                        <!-- <td><?php // echo $reservation->getAddress(); ?></td> -->
                        <td><?php echo $reservation->getPhone(); ?></td>
                        <td><?php echo $reservation->getIsArchived(); ?></td>
                        <td><?php echo $reservation->getIsAdmin(); ?></td>
                        <td>
                            <a href="reservation.php?id=<?php echo $reservation->getId(); ?>" class="btn btn-primary">View</a>
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
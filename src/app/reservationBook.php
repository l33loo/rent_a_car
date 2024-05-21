<?php 

session_start();

// TODO: validate fields

try {
    // TODO: figure out how to revert changes already made when something fails

    // TODO: get userId from session here, not from form?

    // TODO: do we want separate Customer and Billing addresses?

    $address = new Address(
        $_POST['street'],
        $_POST['door'],
        $_POST['apartment'],
        $_POST['city'],
        $_POST['district'],
        $_POST['postalCode'],
        $_POST['countryId']
    );
    $address->save();

    $customer = new Customer(

    );

    $customer->save();

    $reservation = new Reservation(

    );

    // TODO: search credit card and check if the same values
    // no need to create a new credit card if it already exists
    $creditCardDbResult = CreditCard::search([
        [
            'column' => 'ccNumber',
            'operator' => '=',
            'value' => trim($_POST['ccNumber'])
        ],
        [
            'column' => 'ccExpiry',
            'operator' => '=',
            'value' => trim($_POST['ccExpiry'])
        ],
        [
            'column' => 'ccCVV',
            'operator' => '=',
            'value' => trim($_POST['ccCVV'])
        ]
    ]);

    if (count($creditCardDbResults) === 0) {
        $newCreditCard = new CreditCard(
            trim($_POST['ccNumber']),
            trim($_POST['ccExpiry']),
            trim($_POST['ccCVV'])
        );
        $newCreditCard->save();
        $reservation->setCreditCard_id($newCreditCard->getId());
    } else if (count($creditCardDbResults) === 1) {
        $oldCreditCard = $creditCard[0];
        $reservation->setCreditCard_id($oldCreditCard->getId());
    } else {
        // TODO: throw error?
    }

    $reservation->save();
} catch(e) {
    // TODO: handle errors

    // TODO: send back to form with existing data
    header('Location: /html/reservationBook.php');
}
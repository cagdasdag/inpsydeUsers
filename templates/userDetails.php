<?php

// phpcs:disable
declare(strict_types=1);
?>

<div class="inpsyde-users-title">
    <h3><?= $userDetails->name ?>'s Details</h3>
</div>
<div class="inpsyde-users-detail">
    <div class="inpsyde-users-detail-left">Name</div>
    <div class="inpsyde-users-detail-right"><?= $userDetails->name ?></div>
</div>
<div class="inpsyde-users-detail">
    <div class="inpsyde-users-detail-left">User Name</div>
    <div class="inpsyde-users-detail-right"><?= $userDetails->username ?></div>
</div>
<div class="inpsyde-users-detail">
    <div class="inpsyde-users-detail-left">Email</div>
    <div class="inpsyde-users-detail-right"><?= $userDetails->email ?></div>
</div>
<div class="inpsyde-users-detail">
    <div class="inpsyde-users-detail-left">Address</div>
    <div class="inpsyde-users-detail-right"><?= $userDetails->address->street . ' ' . $userDetails->address->suit . ' ' . $userDetails->address->city . ' ' . $userDetails->address->zipcode ?></div>
</div>
<div class="inpsyde-users-detail">
    <div class="inpsyde-users-detail-left">Phone</div>
    <div class="inpsyde-users-detail-right"><?= $userDetails->phone ?></div>
</div>
<div class="inpsyde-users-detail">
    <div class="inpsyde-users-detail-left">Website</div>
    <div class="inpsyde-users-detail-right"><?= $userDetails->website ?></div>
</div>
<div class="inpsyde-users-detail">
    <div class="inpsyde-users-detail-left">Company</div>
    <div class="inpsyde-users-detail-right"><?= $userDetails->company->name ?></div>
</div>
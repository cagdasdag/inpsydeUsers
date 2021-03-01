<?php

// phpcs:disable
declare(strict_types=1);

/**
 * @var array $userList
 */
get_header();
?>
    <?php if($userList): ?>
    <div class="inpsyde-wrapper">
        <table class="inpsyde-users">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($userList as $user) : ?>
                <tr data-userId="<?= esc_html($user->id) ?>">
                    <td data-column="ID">
                        <a href="javascript:void(0)"><?= esc_html($user->id) ?></a>
                    </td>
                    <td data-column="Name">
                        <a href="javascript:void(0)"><?= esc_html($user->name) ?></a>
                    </td>
                    <td data-column="Username">
                        <a href="javascript:void(0)"><?= esc_html($user->username) ?></a>
                    </td>
                    <td data-column="Email"><?= esc_html($user->email) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="inpsyde-popup-mask" role="dialog"></div>
        <div class="inpsyde-popup-modal" role="alert">
            <div class="inpsyde-popup-wrapper">
                <div class="inpsyde-popup-spinner"></div>
                <div class="inpsyde-popup-content"></div>
            </div>
            <button class="inpsyde-popup-modal-close" role="button">X</button>
        </div>
    </div>
    <?php else: ?>
        <div class="inpsyde-wrapper">
            <h3><?php esc_html_e('We have some troubles to get data from API. Please try again.', 'inpsydeUsers') ?></h3>
        </div>
    <?php endif; ?>
<?php get_footer(); ?>
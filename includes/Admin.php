<?php

declare(strict_types=1);

namespace InpsydeUsers;

class Admin
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'createOptionPage']);
        add_action('admin_init', [$this, 'registerSettings']);
        add_action('admin_init', [$this, 'createDefaultUrl']);
    }

    /**
     * Set default value if initial setup
     */
    public function createDefaultUrl()
    {
        if (!get_option('inpsydeCustomUrl')) {
            $defaultEndpoint = apply_filters('inpsyde_default_endpoint', 'inpsyde-users');
            update_option('inpsydeCustomUrl', $defaultEndpoint);
        }
    }

    /**
     * Responsible to create an option page in WordPress Dashboard
     */
    public function createOptionPage()
    {
        $settingPageTitle = __('Inpsyde Users Settings', 'inpsydeUsers');
        add_options_page(
            $settingPageTitle,
            $settingPageTitle,
            'manage_options',
            'inpsyde-users',
            [$this, 'renderSettingPage']
        );
    }

    /**
     * Responsible to render HTML of setting page
     */
    public function renderSettingPage()
    {
        ?>
        <form action="options.php" method="post">
            <?php
            settings_fields('inpsydeCustomUrl');
            do_settings_sections('inpsydeUsersSettingSections'); ?>
            <input
                    name="submit"
                    class="button button-primary"
                    type="submit"
                    value="<?php esc_attr_e('Save'); ?>"
            />
        </form>
        <?php
    }

    /**
     * Register settings for the options page.
     */
    public function registerSettings()
    {
        register_setting('inpsydeCustomUrl', 'inpsydeCustomUrl', [$this, 'settingValidation']);
        add_settings_section(
            'inpsydeUsersSettings',
            __('Inpsyde Users Settings', 'inpsydeUsers'),
            '',
            'inpsydeUsersSettingSections'
        );
        add_settings_field(
            'customUrlField',
            'Custom URL Slug',
            [$this, 'customUrlField'],
            'inpsydeUsersSettingSections',
            'inpsydeUsersSettings'
        );
    }

    /**
     * Display setting input and shortcut link.
     */
    public function customUrlField()
    {
        $customUrlValue = get_option('inpsydeCustomUrl');
        $goToPageUrl = home_url("/?page=" . $customUrlValue);

        echo '<input 
                id="inpsyde-users-url" 
                name="inpsydeCustomUrl" 
                type="text" 
                value="' . esc_attr($customUrlValue) . '" 
              />
              <a 
                href="' . esc_url($goToPageUrl) . '" 
                target="_blank" 
                class="inpsyde-users-go-to-page"
              >' . esc_html__("Go to Page", 'inpsydeUsers') . '</a>';
    }

    /**
     * Validate entered custom URL slug value.
     * It should be slugify.
     *
     * @param string $input
     *
     * @return string
     */
    public function settingValidation(string $input): string
    {
        $input = apply_filters('inpsyde_custom_url_validation', $input);
        $input = sanitize_title($input);

        return $input;
    }
}
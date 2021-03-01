<?php

declare(strict_types=1);

namespace InpsydeUsers;

class Front
{
    public function __construct()
    {
        add_action('wp_ajax_getUserDetail', [$this, 'renderUserDetails']);
        add_action('wp_ajax_nopriv_getUserDetail', [$this, 'renderUserDetails']);
    }

    /**
     * Responsible to render all users table.
     * Firstly sending request to API and collecting all the data.
     * Then parsing this data and showing it in the table.
     */
    public function renderUsersTable()
    {
        $api = new Api();
        $usersListApiUrl = 'https://jsonplaceholder.typicode.com/users/';
        $userList = $api->dataParserFromApi($usersListApiUrl);
        $userList = apply_filters('inpysde_users_list', $userList);
        $template = $this->templatePath('userTable');
        include $template;
    }

    /**
     * Responsible to render user detail popup content.
     * Getting user id from request and getting user details from API with this value.
     * Then parsing this data and showing in popup.
     */
    public function renderUserDetails()
    {
        if (
            isset($_POST['userId'], $_POST['nonce'])
            && wp_verify_nonce(sanitize_key($_POST['nonce']), 'inpsydeNonce')
        ) {
            $api = new Api();
            $userId = sanitize_text_field(wp_unslash($_POST['userId']));
            $userDetailsApiUrl = 'https://jsonplaceholder.typicode.com/users/' . $userId;
            $userDetails = $api->dataParserFromApi($userDetailsApiUrl);
            $userDetails = apply_filters('inpysde_user_details', $userDetails);
            $template = $this->templatePath('userDetails');

            include $template;
            exit;
        }
    }

    /**
     * @param string $templateName Key value for template array.
     * By default, userTable and userDetail are available.
     *
     * @return string Return template path
     */
    public function templatePath(string $templateName): string
    {
        $templatePath = '';
        $templates = $this->templatePathList();
        if (empty($templateName) || empty($templates) || (!array_key_exists($templateName, $templates))) {
            return $templatePath;
        }

        $template = $templates[ $templateName ];

        if (isset($template['path']) && !empty($template['path'])) {
            if (file_exists($template['path'])) {
                $templatePath = $template['path'];
            }
        }

        if (isset($template['templatePath']) && !empty($template['templatePath'])) {
            if (file_exists($template['templatePath'])) {
                $templatePath = $template['templatePath'];
            }
        }

        return apply_filters('inpsyde_template_path', $templatePath, $templateName, $templates);
    }

    /**
     * Collecting paths from plugin and theme
     *
     * @return array filtered $templates
     * An array of templates with key, default path and override path
     */
    public function templatePathList(): array
    {
        $themePath = get_template_directory();
        $templates = [
            'userTable' => [
                'path' => INPSYDE_DIR_PATH . 'templates/userTable.php',
                'templatePath' => $themePath . '/inpysde-templates/userTable.php',
            ],
            'userDetails' => [
                'path' => INPSYDE_DIR_PATH . 'templates/userDetails.php',
                'templatePath' => $themePath . '/inpysde-templates/userDetails.php',
            ],
        ];

        return apply_filters('inpsyde_template_path_list', $templates);
    }
}

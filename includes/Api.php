<?php

declare(strict_types=1);

namespace InpsydeUsers;

class Api
{
    /**
     * Get all the users from API
     * Cache the response for 300 seconds into transient
     *
     * @param string $apiUrl
     *
     * @return array|mixed
     */
    public function dataParserFromApi(string $apiUrl)
    {
        if (!empty($apiUrl)) {
            $uniqueKey = md5(json_encode(['apiUrl' => $apiUrl]));
            $transientKey = 'inpysde_' . $uniqueKey;
            $data = get_transient($transientKey);
            if (empty($data)) {
                $data = $this->sendRequestToApi($apiUrl, $transientKey);
            }
        }

        return $data;
    }

    /**
     * Send request to Api and set transient for caching
     *
     * @param string $apiUrl
     * @param string $transientKey
     *
     * @return array|mixed
     */
    public function sendRequestToApi(string $apiUrl, string $transientKey)
    {
        $request = wp_remote_get($apiUrl);
        $data = false;
        if (!is_wp_error($request)) {
            $result = null;

            $body = wp_remote_retrieve_body($request);
            $data = json_decode($body);
            set_transient($transientKey, $data, 300);
        }

        return $data;
    }
}

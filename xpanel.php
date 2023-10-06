<?php

declare(strict_types=1);

class xpanelssh
{
    private $link;
    private $user;
    private $pass;
    private $token;

    /**
     * @param string $Link url of your panel without / end of it
     * @param string $token api token of your panel you can get if from panel settings
     * @param string $user username of panel
     * @param string $pass password of panel
     * 
     */
    public function __construct(string $link, string $token, string $user, string $pass)
    {
        $this->link = $link . '/api/';
        $this->token = $token;
        $this->user = $user;
        $this->pass = $pass;
    }



    public function add_client(string $user, string $pass, string $mobile = null, int $multi_user = 1, int $traffic = 1, string  $type_traffic = 'gb', string $expdate = '', string $conn_start = '', string $desc = ''): string
    {
        $settings = [
            'token' => $this->token,
            'username' => $user,
            'password' => $pass,
            'mobile' => $mobile,
            'multiuser' => $multi_user,
            'traffic' => $traffic,
            'type_traffic' => $type_traffic,
            'expdate' => $expdate,
            'connection_start' => $conn_start,
            'desc' => $desc

        ];

        return $this->run_request($this->link . 'adduser', method: 'POST', post_data: $settings);
    }

    /**
     * @param string $username username | email of client
     * @return array info about user
     */
    public function client_info(string $username): array
    {


        return json_decode($this->run_request($this->link . $this->token . '/user/' . $username), true);
    }


    /**
     * @param string $url url of address for make request
     * @param string $method method of request between POST and GET default is GET
     * @param string $post_data data of post request if you are using post request
     */

    public function run_request(string $url, string $method = 'GET', array $post_data = null): string
    {

        $opt = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4
        ];

        if ($method == 'POST') {
            $opt[CURLOPT_POST] =  true;
            $opt[CURLOPT_POSTFIELDS] = $post_data;
        }


        $ch = curl_init($url);
        curl_setopt_array(
            $ch,
            $opt

        );

        $res = curl_exec($ch);
        if (curl_errno($ch)) {

            throw new Exception($res . curl_error($ch));
        }
        curl_close($ch);
        return $res;
    }
}

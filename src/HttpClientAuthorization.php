<?php

namespace leocata\M1;

/**
 * Class HttpClientAuthorization
 * @package leocata\M1
 */
class HttpClientAuthorization
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * HttpClientAuthorization constructor.
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * The authorization header will be generated and added as a custom header
     * @return array
     */
    public function getBasicAuth(): array
    {
        return [
            'Authorization' => 'Basic ' . base64_encode($this->username . ':' . $this->password),
        ];
    }
}

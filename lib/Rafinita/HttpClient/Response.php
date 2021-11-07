<?php

namespace App\Rafinita\HttpClient;

/**
 * Class Response
 *
 * @package App\Rafinita\HttpClient
 *
 * @author horaiwork4@gmail.com
 */
class Response implements ResponseInterface
{
    public int $httpStatus;
    public string $body;
    /**
     * Response constructor.
     *
     * @param string $body
     */
    public function __construct(int $httpStatus, string $body)
    {
        $this->httpStatus = $httpStatus;
        $this->body = $body;
        return $this;
    }
    /**
     * @return int
     */
    public function getStatusCode(): string
    {
        return $this->body;
    }
    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }
    /**
     * @return mixed
     */
    public function toArray()
    {
        return json_decode($this->body, true);
    }
}

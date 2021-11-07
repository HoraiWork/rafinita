<?php

namespace App\Rafinita\HttpClient;

/**
 * Interface ResponseInterface
 *
 * @package App\Rafinita\HttpClient
 *
 * @author horaiwork4@gmail.com
 */
interface ResponseInterface
{
    /**
     * @return int Status code.
     */
    public function getStatusCode();
    /**
     * @return string
     */
    public function getBody(): string;
}

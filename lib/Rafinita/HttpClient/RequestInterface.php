<?php

namespace App\Rafinita\HttpClient;

/**
 * Interface RequestInterface
 *
 * @package App\Rafinita\HttpClient
 *
 * @author horaiwork4@gmail.com
 */
interface RequestInterface
{
    /**
     * @return array
     */
    public function all(): array;
    /**
     * @param array $parameters
     * @return mixed
     */
    public function add(array $parameters = []);
    /**
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function get(string $key, $default = null);
    /**
     * @param string $key
     * @param $value
     * @return mixed
     */
    public function set(string $key, $value);
    /**
     * @param string $key
     * @return mixed
     */
    public function has(string $key);
    /**
     * @return array
     */
    public function getParameters(): array;
    /**
     * @param array $parameters
     * @return mixed
     */
    public function setParameters(array $parameters);
}

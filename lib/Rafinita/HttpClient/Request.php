<?php

namespace App\Rafinita\HttpClient;

/**
 * Class Request
 *
 * @package App\Rafinita\HttpClient
 *
 * @author horaiwork4@gmail.com
 */
class Request implements RequestInterface
{
    public $parameters;
    /**
     * @param array $query
     */
    public function __construct(array $parameters = [])
    {
        $this->setParameters($parameters);
    }
    /**
     * @return array
     */
    public function all(): array
    {
        return $this->getParameters();
    }
    /**
     * @return array
     */
    public function keys(): array
    {
        return array_keys($this->getParameters());
    }
    /**
     * @param array $parameters
     */
    public function add(array $parameters = [])
    {
        $this->setParameters(array_replace($this->getParameters(), $parameters));
    }
    /**
     * @param  string $key
     * @param  null   $default
     * @return mixed|null
     */
    public function get(string $key, $default = null)
    {
        return \array_key_exists($key, $this->getParameters()) ? $this->getParameters()[$key] : $default;
    }
    /**
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value)
    {
        $this->parameters[$key] = $value;
    }
    /**
     * @param  string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return \array_key_exists($key, $this->getParameters());
    }
    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
    /**
     * @param array $parameters
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }
}

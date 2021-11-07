<?php

namespace App\Rafinita\HttpClient;

/**
 * Class RafinitaCurl
 *
 * @package App\Rafinita\HttpClient
 *
 * @author horaiwork4@gmail.com
 */
class RafinitaCurl
{
    public $curl;
    /**
     * Make a new curl reference instance
     */
    public function init()
    {
        $this->curl = curl_init();
    }
    /**
     * @param $key
     * @param $value
     */
    public function setopt($key, $value)
    {
        curl_setopt($this->curl, $key, $value);
    }
    /**
     * @param array $options
     */
    public function setoptArray(array $options)
    {
        curl_setopt_array($this->curl, $options);
    }
    /**
     * @return bool|string
     */
    public function exec()
    {
        return curl_exec($this->curl);
    }
    /**
     * @return int
     */
    public function errno()
    {
        return curl_errno($this->curl);
    }
    /**
     * @return string
     */
    public function error()
    {
        return curl_error($this->curl);
    }
    /**
     *
     */
    public function close()
    {
        curl_close($this->curl);
    }
    /**
     * @param $type
     * @return mixed
     */
    public function getinfo($type)
    {
        return curl_getinfo($this->curl, $type);
    }
}

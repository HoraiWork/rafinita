<?php

declare(strict_types=1);

namespace App\Rafinita\HttpClient;

/**
 * Class RafinitaHttpConfig
 *
 * @package App\Rafinita\HttpClient
 *
 * @author horaiwork4@gmail.com
 */
class RafinitaHttpConfig
{
    /*
     *  Default curl
     */
    protected const URL = 'https://dev-api.rafinita.com/post';
    protected const HTTP_POST = 'POST';
    /**
     * Some default options for curl
     *
     * @var array
     */
    public static $defaultCurlOptions = [
        CURLOPT_URL => self::URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_SSLVERSION => 6,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => self::HTTP_POST,
    ];
    public array $curlOptions;
    public function __construct()
    {
        $this->setCurlOptions(self::$defaultCurlOptions);
    }
    /**
     * @return array
     */
    public function getCurlOptions(): array
    {
        return $this->curlOptions;
    }
    /**
     * @param array $curlOptions
     */
    public function setCurlOptions(array $curlOptions)
    {
        $this->curlOptions = $curlOptions;
    }
}

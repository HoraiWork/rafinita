<?php

namespace App\Rafinita\HttpClient;

use App\Rafinita\Exception\RafinitaException;
use App\Rafinita\Helpers\HashGenerate;

/**
 * Class RafinitaClient
 *
 * @package App\Rafinita\HttpClient
 *
 * @author horaiwork4@gmail.com
 */
class RafinitaClient
{
    /**
     * @var string
     */
    public $clientKey;
    /**
     * @var string
     */
    public $clientPass;
    /**
     * @var RafinitaCurl
     */
    protected $curl;
    /**
     * @var RequestInterface
     */
    protected $request = [];
    protected array $curlOptions;
    /**
     * RafinitaClient constructor.
     * @param $clientKey
     * @param $clientPass
     * @throws RafinitaException
     */
    public function __construct($clientKey, $clientPass)
    {
        if (empty($clientKey)) {
            throw new RafinitaException("Client key is empty");
        }
        if (empty($clientPass)) {
            throw new RafinitaException("Client pass is empty");
        }
        $this->setClientKey(trim($clientKey));
        $this->setClientPass(trim($clientPass));
        $this->initialize();
    }
    /**
     * Re-initializes all properties.
     */
    public function initialize()
    {
        $this->setCurl(new RafinitaCurl());
        $this->setCurlOptions(new RafinitaHttpConfig());
        $this->getCurl()->init();
    }
    /**
     * @param  RequestInterface $request
     * @return ResponseInterface
     * @throws RafinitaException
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $this->setRequest($request);
        $this->getCurl()->setoptArray($this->getCurlOptions());
        $this->getCurl()->setopt(CURLOPT_POSTFIELDS, $this->getRequest()->all());
        $response = $this->getCurl()->exec();
        if ($this->getCurl()->errno()) {
            $exception = new RafinitaException(
                $this->getCurl()->error(),
                $this->getCurl()->errno()
            );
            $this->getCurl()->close();
            throw $exception;
        }
        $httpStatus = $this->getCurl()->getinfo(CURLINFO_HTTP_CODE);
        $this->getCurl()->close();
        return (new Response($httpStatus, $response));
    }
    /**
     * @return RequestInterface|array
     */
    public function getRequest(): RequestInterface|array
    {
        $this->request->set('client_key', $this->getClientKey());
        $this->request->set('client_pass', $this->getClientPass());
        $this->createHash();
        return $this->request;
    }
    /**
     * @param  RequestInterface|array $request
     * @return RafinitaClient
     */
    public function setRequest(RequestInterface|array $request): RafinitaClient
    {
        $this->request = $request;
        return $this;
    }
    /**
     * @return array
     */
    public function getCurlOptions(): array
    {
        return $this->curlOptions;
    }
    /**
     * @param RafinitaCurl $curl
     */
    public function setCurl(RafinitaCurl $curl)
    {
        $this->curl = $curl;
    }
    /**
     * @return RafinitaCurl
     */
    public function getCurl(): RafinitaCurl
    {
        return $this->curl;
    }
    /**
     * @param  RafinitaHttpConfig $curlOptions
     * @return RafinitaClient
     */
    public function setCurlOptions(RafinitaHttpConfig $curlOptions): RafinitaClient
    {
        $this->curlOptions = $curlOptions->getCurlOptions();
        return $this;
    }
    /**
     * @return void
     */
    private function createHash(): void
    {
        $this->request->set('hash', HashGenerate::create($this->request, $this));
    }
    /**
     * @return string
     */
    public function getClientKey(): string
    {
        return $this->clientKey;
    }
    /**
     * @param string $clientKey
     */
    public function setClientKey(string $clientKey): void
    {
        $this->clientKey = $clientKey;
    }
    /**
     * @return string
     */
    public function getClientPass(): string
    {
        return $this->clientPass;
    }
    /**
     * @param string $clientPass
     */
    public function setClientPass(string $clientPass): void
    {
        $this->clientPass = $clientPass;
    }
}

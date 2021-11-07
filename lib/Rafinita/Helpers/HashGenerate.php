<?php

namespace App\Rafinita\Helpers;

use App\Rafinita\HttpClient\RafinitaClient;
use App\Rafinita\HttpClient\RequestInterface;

/**
 * Class HashGenerate
 *
 * @package App\Rafinita\Helpers
 *
 * @author horaiwork4@gmail.com
 */
class HashGenerate
{
    /**
     *
     * @param RequestInterface $request
     * @param RafinitaClient   $client
     *
     * @return string
     */
    public static function create(RequestInterface $request, RafinitaClient $client): string
    {
        return match ($request->get('action')) {
            'SALE' => md5(
                strtoupper(
                    strrev($request->get('payer_email')) .
                    $client->getClientPass() .
                    strrev(substr($request->get('card_number'), 0, 6) .
                        substr($request->get('card_number'), -4))
                )
            ),
            default => '',
        };
    }
}

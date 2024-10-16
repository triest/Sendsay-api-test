<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class HttpRequestClass
{

    private ?Client $http = null;

    /**
     * @param Client $http
     */
    public function __construct()
    {
        $this->http = new Client($this->setHttpConfig());
    }

    private function setHttpConfig(): array
    {
        return [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]
        ];
    }


    public function post($url, $data)
    {
        $promise = $this->http
            ->postAsync(
                $url,
                [RequestOptions::JSON => $data]
            )->then(
                function (ResponseInterface $response) {
                    if($response->getStatusCode()!=200){
                        throw new \Exception('Login error');
                    }
                    $temp = $response->getBody()->getContents();

                    $response = json_decode($temp,true);

                    return $response;
                },
                function (RequestException $e) {
                    $response = [];

                    //$response->data = $e->getMessage();
                    throw new \Exception($e->getMessage());

                   //return $response;
                }
            );
        self::schedulePromise([$promise, 'wait'], false);

        return $promise->wait();
    }


    public static function schedulePromise($callable, ...$args)
    {
        register_shutdown_function(function ($callable, ...$args) {
            @session_write_close();
            @ignore_user_abort(true);
            call_user_func($callable, ...$args);
        }, $callable, ...$args);
    }


}

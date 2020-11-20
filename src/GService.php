<?php

namespace GExpress\GService;

use Ixudra\Curl\CurlService as BaseCurlService;

class GService
{
    protected $curlService;

    public function __construct()
    {
        $this->curlService = new CurlService(new BaseCurlService());
    }

    public function getNewAccessToken()
    {
        $client_id = config('gservice.client_id');
        $client_secret = config('gservice.client_secret');
        $grant_type = config('gservice.grant_type');
        $scope = config('gservice.scope');
        $urlAuthApi = config('gservice.api_endpoints.auth');
        $headers = [
            'Cache-Control' => 'no-cache'
        ];
        $data = [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'grant_type' => $grant_type,
            'scope' => $scope
        ];
        $baseCurlSer = new BaseCurlService;
        $curl = $baseCurlSer->to($urlAuthApi)->withData($data);
        $curl->withHeaders($headers);
        $curl->withContentType('application/json');
        $response = $curl->asJson()->post();
        session(['access_token' => $response->access_token]);
        return $response;
    }


    public function get($url, $data = [], $headers = []) {
        return $this->curlService->get($url, $data, $headers);
    }

    public function post($url, $data = [], $headers = [], $contentType = '', $files = [], $isJson = true) {
        return $this->curlService->post($url, $data, $headers, $contentType, $files, $isJson);
    }

    public function put($url, $data = [], $headers = []) {
        return $this->curlService->put($url, $data, $headers);
    }

    public function delete($url, $data = [], $headers = []) {
        return $this->curlService->delete($url, $data, $headers);
    }
}

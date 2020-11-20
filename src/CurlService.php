<?php

namespace GExpress\GService;

use Ixudra\Curl\CurlService as BaseCurlSer;

class CurlService
{
    protected $curl;

    public function __construct(BaseCurlSer $curl)
    {
        $this->curl = $curl;
    }

    /**
     * curl with method 'GET'
     * @param $url
     * @param array $data
     * @param array $headers
     * @return mixed
     */
    public function get($url, $data = [], $headers = [])
    {
        return $this->appendTo($url, $data, $headers)->get();
    }

    /**
     * request with method 'POST'
     * @param $url
     * @param array $data
     * @param array $headers
     * @param string $contentType
     * @param array $files
     * @param bool $isJson
     * @return mixed
     */
    public function post($url, $data = [], $headers = [], $contentType = '', $files = [], $isJson = true)
    {
        return $this->appendTo($url, $data, $headers, $contentType, $files, $isJson)->post();
    }

    /**
     * request with method 'PUT'
     * @param $url
     * @param array $data
     * @param array $headers
     * @return mixed
     */
    public function put($url, $data = [], $headers = [])
    {
        return $this->appendTo($url, $data, $headers)->put();
    }

    /**
     * request with method 'DELETE'
     * @param $url
     * @param array $data
     * @param array $headers
     * @return mixed
     */
    public function delete($url, $data = [], $headers = [])
    {
        return $this->appendTo($url, $data, $headers)->delete();
    }

    private function appendTo($url, $data = [], $headers = [], $contentType = null, $file = [], $isJson = true)
    {
        $headers = array_replace($headers, [
            'Authorization' => 'Bearer ' . session('access_token')
        ]);
        $curl = $this->curl->to($url)->withData($data);

        if(!empty($file))
        {
            $curl->withFile($file['name'], $file['path'], $file['mime'], $file['original_name']);
        }

        if(!empty($contentType))
        {
            $curl->withContentType($contentType);
        }

        if (!empty($headers))
        {
            $curl->withHeaders($headers);
        }
        return $isJson ? $curl->asJson() : $curl;
    }
}

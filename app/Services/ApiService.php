<?php

namespace App\Services;

class ApiService
{
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getData()
    {
        // Use the API key to retrieve data from an external API
        // ...

        return [
            'foo' => 'bar',
            'baz' => 'qux',
        ];
    }
}

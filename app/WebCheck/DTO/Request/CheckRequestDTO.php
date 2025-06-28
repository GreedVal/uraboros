<?php

namespace App\WebCheck\DTO\Request;

class CheckRequestDTO
{
    public string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getHost(): string
    {
        return parse_url($this->url, PHP_URL_HOST) ?? $this->url;
    }
}

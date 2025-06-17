<?php

namespace App\Http\Controllers\CheckWeb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WebCheck\Services\WebCheckService;
use App\WebCheck\DTO\Request\CheckRequestDTO;


class GetInfoWebController extends Controller
{
    public function __construct(
        protected WebCheckService $checkWeb
    ) {}

    public function index() {


        $dto = new CheckRequestDTO(
            url: 'https://dzasden.ru'
        );


        $result = $this->checkWeb->checkRedirects($dto);

        dd($result);

        return [];
    }
}

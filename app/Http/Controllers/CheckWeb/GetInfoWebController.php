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
            url: 'https://dzesdn.ru'
        );


        $result = $this->checkWeb->checkAll($dto);

        dd($result);

        return [];
    }
}

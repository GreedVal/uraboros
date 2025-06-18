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

        return view('check-web.get-info-web');

    }

    public function search(Request $request) {

        if (!filter_var($request->url, FILTER_VALIDATE_URL)) {
            return redirect()->back()->with('status', 'Недопустимый URL.');
        }

        $dto = new CheckRequestDTO(
            url: $request->url
        );

        $result = $this->checkWeb->checkAll($dto);

        return view('check-web.get-info-web-result', ['result' => $result]);
    }
}

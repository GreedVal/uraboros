<?php

namespace App\Http\Controllers\Web;

use App\WebCheck\DTO\Request\CheckRequestDTO;
use App\WebCheck\Services\WebCheckService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class InfoSiteController extends Controller
{
    public function __construct(
        protected WebCheckService $webCheckService
    ) {
    }

    public function __invoke(Request $request)
    {   
        $dto = new CheckRequestDTO(
            url: $request->input('query')
        );

        $result = $this->webCheckService->checkAll($dto);

        return Inertia::render('web/InfoSite', ['data' => $result]);
    }
}

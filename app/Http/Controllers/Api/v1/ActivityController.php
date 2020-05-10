<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Activity\StoreRequest;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function cleaningStr(string $data): string
    {
        return strip_tags(trim($data));
    }
    public function store(Request $request)
    {
        return ['result'=>$request->all()];
    }
}

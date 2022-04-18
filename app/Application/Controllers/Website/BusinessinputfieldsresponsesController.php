<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Illuminate\Http\Request;

class BusinessinputfieldsresponsesController extends AbstractController {


    public function store (Request $request) {

        dd($request->all());

    }
}
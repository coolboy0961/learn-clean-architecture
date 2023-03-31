<?php

namespace App\Gateway\Controllers;

class HelloWorldController extends Controller
{
    public function helloWorld()
    {
        return response()->json(['message' => 'Hello World']);
    }
}

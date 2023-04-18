<?php

namespace App\Adapters\Controllers;

class HelloWorldController extends Controller
{
    public function helloWorld()
    {
        return response()->json(['message' => 'Hello World']);
    }
}

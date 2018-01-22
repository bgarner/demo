<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;
use DB;

class DirtyNodesController extends Controller
{
    public $storeNumber;

    public function __construct()
    {
        $this->storeNumber = RequestFacade::segment(1);
    }

    public function index()
    {
        return "hello, dirty nodes";
    }
}

<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as RequestFacade;
use DB;
use App\Models\Tools\DirtyNode\DirtyNode;

class DirtyNodesController extends Controller
{
    public $storeNumber;

    public function __construct()
    {
        $this->storeNumber = RequestFacade::segment(1);
    }

    public function index()
    {
        $data = DirtyNode::getDataByStoreNumber($this->storeNumber);
        $cleanNodes = DirtyNode::getCleanNodesByStoreNumber($this->storeNumber);
        $topItems = DirtyNode::getTopDirtyNodeItems($this->storeNumber);
        $topCategories = DirtyNode::getTopDirtyNodeCategories($this->storeNumber);

        return view('site.tools.dirtynodes.index')
            ->with('data', $data)
            ->with('topItems', $topItems)
            ->with('topCategories', $topCategories)
            ->with('cleanNodes', $cleanNodes);
    }

    public function pdt()
    {
        $data = DirtyNode::getDataByStoreNumber($this->storeNumber);
        return view('site.tools.dirtynodes.pdt')
            ->with('data', $data);
    }

    public function update(Request $request)
    {
        DirtyNode::cleanNode($request);
    }


}
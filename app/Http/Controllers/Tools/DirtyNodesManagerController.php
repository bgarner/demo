<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tools\DirtyNode\DirtyNodeArchive;
use App\Models\Tools\DirtyNode\DirtyNode;
use App\Models\Tools\CustomStoreGroup;
use App\Models\Auth\User\UserBanner;
use App\Models\StoreApi\StoreInfo;
use App\Models\StoreApi\Banner;
use App\Models\Utility\Utility;


class DirtyNodesManagerController extends Controller
{
    public function index()
    {
    	$this->user_id = \Auth::user()->id;
        $storeInfo = StoreInfo::getStoreListingByManagerId($this->user_id);
        $this->stores = array_column($storeInfo, 'store_number');

        foreach ($this->stores as &$store) {
        	$store = ltrim(ltrim($store, '0'), 'A');
        }
        
        $this->stores = array_unique($this->stores);

       	$cleanedLastWeek = DirtyNodeArchive::getCleanedNodesForStoreList($this->stores);
       	$outstanding = DirtyNode::getTotalDirtyNodesOutstanding($this->stores);
       	$oldestDirtyNode = DirtyNode::getOldestDirtyNode($this->stores);   	
       	
        return view('manager.dirtynodes.index')->with('cleanedLastWeek', $cleanedLastWeek)
        									->with('outstanding', $outstanding)
        									->with('oldestDirtyNode', $oldestDirtyNode)
        									->with('stores', $this->stores);
        										
    }
}

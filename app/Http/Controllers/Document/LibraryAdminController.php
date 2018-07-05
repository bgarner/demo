<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\Banner;
use App\Models\Document\FolderStructure;
use App\Models\Document\Folder;
use App\Models\Document\Package;
use App\Models\Communication\Communication;
use App\Models\Auth\User\User;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserSelectedBanner;

class LibraryAdminController extends Controller
{
    public function index(Request $request)
    {

        $banner = UserSelectedBanner::getBanner();

        $navigation = FolderStructure::getNavigationStructure($banner->id);

        $packages = Package::getAllPackages($banner->id);

        $packageHash = sha1(time() . time());

        $folders = Folder::all();

        $defaultFolder = $request->get('parent');

        if (!isset($defaultFolder)) {
            $defaultFolder = null;
        }

        return view('admin.documentmanager.index')
            ->with('navigation', $navigation)
            ->with('folders', $folders)
            ->with('packageHash', $packageHash)
            ->with('banner', $banner)
            ->with('packages', $packages)
            ->with('defaultFolder' , $defaultFolder);

    }
}

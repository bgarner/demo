<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Document\Package;

class PackagePartialController extends Controller
{
    public function getPackageDocumentPartial($package_id)
    {
        $documents = Package::getPackageDocumentDetails($package_id);
        return view('admin.package.package-documents-partial')->with('documentDetails', $documents);
    }

    public function getPackageFolderPartial($package_id)
    {
        $folders = Package::getPackageFolderDetails($package_id);
        return view('admin.package.package-folders-partial')->with('folders', $folders);
    }
}

<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;
use App\Models\Document\Package;

class CommunicationPackage extends Model
{
   protected $table = 'communication_package';
   protected $fillable = ['communication_id', 'package_id'];

   public static function updateCommunicationPackages($id, $request)
	{
		$remove_packages = $request["remove_package"];
		if (isset($remove_packages)) {
			foreach ($remove_packages as $package) {
			   CommunicationPackage::where('communication_id', $id)->where('package_id', intval($package))->delete();
			}
		}

		$add_packages = $request["communication_packages"];
		if (isset($add_packages)) {
			foreach ($add_packages as $package) {
				CommunicationPackage::create([
					'communication_id'=> $id,
					'package_id'      => $package
				]);
			}
		}
	}

	public static function getPackagesByCommunicationId($id)
	{
		$communication_package_list = CommunicationPackage::where('communication_id', $id)->get();

		$packages = [];
		foreach ($communication_package_list as $list_item) {
			$package = Package::find($list_item->package_id);
			$package["documents"] = [];
			$package_docs = Package::getPackageDocumentDetails($list_item->package_id);
			$package["documents"] = $package_docs;
			array_push($packages, $package);
		}
		return $packages;
	}

}

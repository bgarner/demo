<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;

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

}

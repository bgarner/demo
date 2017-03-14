<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Document\Package;

class FeaturePackage extends Model
{
    use SoftDeletes;
    protected $table = 'feature_package';
    protected $fillable = ['feature_id', 'package_id', 'order'];
    protected $dates = ['deleted_at'];

    public static function getFeaturePackages($feature_id)
    {
    	$feature_packages = FeaturePackage::where('feature_id', $feature_id)->orderBy('order')->get()->pluck('package_id');
        $selected_packages = [];
        foreach ($feature_packages as $package_id) {
            $package = Package::find($package_id);
            $package_details = Package::getPackageDetails($package_id, true);
            $package['details'] = $package_details;
            array_push($selected_packages, $package);
        }

        return $selected_packages;
    }

    public static function getFeaturePackagesArray($feature_id)
    {
        return FeaturePackage::where('feature_id', $feature_id)->get()->pluck('package_id')->toArray();
    }
}

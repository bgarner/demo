<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;

class FeatureTarget extends Model
{
    protected $table = 'feature_target';
    protected $fillable = ['feature_id', 'store_id'];

    public static function updateFeatureTarget($id, $request)
    {
        $target_stores = $request['target_stores'];
        $allStores = $request['all_stores'];
        if($allStores == 'on') {
            FeatureTarget::where('feature_id', $id)->delete();
            $feature = Feature::find($id);
            $feature->all_stores = 1;
            $feature->save();
        }
        else{
            FeatureTarget::where('feature_id', $id)->delete();
            if (count($target_stores) > 0) {
                foreach ($target_stores as $store) {
                    FeatureTarget::create([
                        'feature_id' => $id,
                        'store_id'   => $store
                    ]);
                }
                if(!in_array('0940', $target_stores)){
                    Utility::addHeadOffice($id, 'feature_target', 'feature_id');    
                }
                
                
            } 
            $feature = Feature::find($id);
            $feature->all_stores = 0;
            $feature->save();
        }
         
        return;
    }
}

<?php

namespace App\Models\Form\ProductRequest;

use Illuminate\Database\Eloquent\Model;

class FormUserBusinessUnitMap extends Model
{
    protected $table = 'form_business_unit_user';

    protected $fillable = ['user_id', 'business_unit_id'];

    public static function getBUIdBuUserId($user_id)
    {
    	$userBU = Self::where('user_id', $user_id)->first();
    	if($userBU)
    	{
    		return $userBU->business_unit_id;
    	}
    	else return null;
    }

    public static function updateBusinessUnit($user_id, $business_unit_id)
    {
        
        if(isset($business_unit_id)){

            Self::updateOrCreate(
                        ['user_id' => $user_id],
                        ['business_unit_id' => $business_unit_id]
                    );

        }    
        else{
            Self::where('user_id', $user_id)->delete();
        }

        return;
    }

    public static function getBusinessUnitsByFormUserId($user_id)
    {
        return FormUserBusinessUnitMap::join('form_business_unit_types', 'form_business_unit_types.id', '=', 'form_business_unit_user.business_unit_id')
                            ->where('user_id', $user_id)
                            ->select('form_business_unit_types.*')
                            ->get()->pluck('business_unit', 'id')->toArray();
    }
}

<?php

namespace App\Models\Form\ProductRequest;

use Illuminate\Database\Eloquent\Model;

class FormUserBusinessUnitMap extends Model
{
    protected $table = 'form_business_unit_user';

    protected $fillable = ['user_id', 'business_unit_id'];

    public static function getBUIdByUserId($user_id)
    {
    	$userBU = Self::where('user_id', $user_id)->get();
    	if($userBU)
    	{
    		return $userBU->pluck('business_unit_id');
    	}
    	else return null;
    }

    public static function updateBusinessUnit($user_id, $business_unit)
    {
        
        Self::where('user_id', $user_id)->delete();

        if(isset($business_unit)){

            foreach ($business_unit as $bu) {
                 Self::create([
                        'user_id' => $user_id,
                        'business_unit_id' => $bu
                    ]);
            }
           
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

    public static function getBusinessUnitIdsByFormUserId($user_id)
    {
        return array_keys(Self::getBusinessUnitsByFormUserId($user_id));
    }

    public static function getUsersByCurrentBusinessUnitIdAndManagerRole()
    {
        $currentBusinessUnit = FormUserBusinessUnitMap::where('user_id', \Auth::user()->id)->get()->pluck('business_unit_id')->toArray();
        
        return Self::join('users', 'users.id', '=', 'form_business_unit_user.user_id')
                ->whereIn('business_unit_id', $currentBusinessUnit)
                ->select('users.*')
                ->get();
    }
}

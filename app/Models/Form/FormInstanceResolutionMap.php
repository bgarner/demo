<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Form\ProductRequest\BusinessUnitTypes;

class FormInstanceResolutionMap extends Model
{
    protected $table = 'form_instance_resolution_code_map';
    protected $fillable = ['form_instance_id', 'resolution_code_id'];
    public static $launch_date = '2018-07-05 00:00:00';

    public static function updateFormInstanceResolution($form_instance_id, $resolution_code_id)
    {
    	$resolutionCode = $resolution_code_id;
        $formInstanceId = $form_instance_id;

        if(Self::where('form_instance_id', $formInstanceId)->first()){
        	$formResolution = Self::where('form_instance_id', $formInstanceId)->first();
        	$formResolution->resolution_code_id = $resolutionCode;
        	$formResolution->save();
        }
        else{
        	
        	$formResolution = Self::create([
	            "form_instance_id" => $formInstanceId,
	            "resolution_code_id" => $resolutionCode
        	]);	
        }

        return $formResolution;
    }

    public static function getResolutionCodeByFormInstanceId($form_instance_id)
    {
        $resolutionCode = Self::join('form_resolution_code', 'form_resolution_code.id', '=', 'form_instance_resolution_code_map.resolution_code_id')
                    ->where('form_instance_resolution_code_map.form_instance_id', $form_instance_id)
                    ->select('form_resolution_code.id', 'form_resolution_code.resolution_code' )
                    ->first();

        return $resolutionCode;
        
    }

    public static function getResolutionCodeCountByCategory($since = null)
    {
        
        $businessUnits = BusinessUnitTypes::all();

        $report = [];

        foreach ($businessUnits as $key => $bu) {

            $report[$bu->business_unit] = FormInstanceResolutionMap::join('form_resolution_code', 'form_instance_resolution_code_map.resolution_code_id', '=', 'form_resolution_code.id')
                ->join('form_data', 'form_data.id', '=', 'form_instance_resolution_code_map.form_instance_id')
                ->when($since, function($query) use($since) {
                    return $query->where('form_instance_resolution_code_map.updated_at', '>=', $since);
                }, function($query){
                    $query->where('form_instance_resolution_code_map.updated_at', '>=', Self::$launch_date);
                })
                ->where('form_data.business_unit_id', $bu->id)
                ->select(\DB::raw(' form_resolution_code.resolution_code, 
                    count(form_instance_resolution_code_map.resolution_code_id) as count,
                    count(form_instance_resolution_code_map.resolution_code_id) as percentage
                    '))
                ->groupBy('form_resolution_code.resolution_code')
                ->get();
            
            $total = 0;
            
            foreach ($report[$bu->business_unit] as $resolution) {
                $total += $resolution->count;
            }
            

            foreach ($report[$bu->business_unit] as $key=>$resolution) {
                $report[$bu->business_unit][$key]['percentage'] = round(($resolution['count'] * 100)/ $total, 2);
                $report[$bu->business_unit][$key]['total'] = $total;
            }

        }

        return ( $report );
        
    }

    public static function getResolutionCodeCountByFilter($filters, $since = null)
    {

        
        $department = '';
        $category = '';
        $subcategory = '';

        if(isset($filters["department"])){
            $department = $filters["department"];
        }
        if(isset($filters["category"])){
            $category = $filters["category"];
        }
        if(isset($filters["subcategory"])){
            $subcategory = $filters["subcategory"];
        }
        $report = [];

        $report = FormData::leftJoin('form_instance_resolution_code_map', 'form_data.id', '=', 'form_instance_resolution_code_map.form_instance_id')
            ->leftJoin('form_resolution_code', 'form_instance_resolution_code_map.resolution_code_id', '=', 'form_resolution_code.id')
            ->when($since, function($query) use($since) {
                return $query->where('form_instance_resolution_code_map.updated_at', '>=', $since);
            }, function($query){
                $query->where('form_instance_resolution_code_map.updated_at', '>=', Self::$launch_date);
            })
            ->when($department, function($query) use($department){
                // $query->where('form_data.json_form_data->department', $department);
                $query->whereRaw("json_contains(`json_form_data`, '{\"department\" : \"$department\"}')");
            })
            ->when($category, function($query) use($category){
            //     $query->where('form_data.json_form_data->category', $category);
                $query->whereRaw("json_contains(`json_form_data`, '{\"category\" : \"$category\"}')");
            })
            ->when($subcategory, function($query) use($subcategory){
            //     $query->where('form_data.json_form_data->subcategory', $subcategory);
                $query->whereRaw("json_contains(`json_form_data`, '{\"subcategory\" : \"$subcategory\"}')");
            })
            ->select(\DB::raw(' form_resolution_code.resolution_code, 
                count(form_instance_resolution_code_map.resolution_code_id) as count,
                count(form_instance_resolution_code_map.resolution_code_id) as percentage
                '))
            ->groupBy('form_resolution_code.resolution_code')
            ->get();
        
        $total = 0;
        
        foreach ($report as $data) {
            $total += $data->count;
        }
        

        foreach ($report as $key=>$resolution) {
            $report[$key]['percentage'] = round(($resolution['count'] * 100)/ $total, 2);
            $report[$key]['total'] = $total;
        }

        return ( $report );
    }

    public static function getResolutionDetailsByFilter($filters, $since= null)
    {

        $department = '';
        $category = '';
        $subcategory = '';

        if(isset($filters["department"])){
            $department = $filters["department"];
        }
        if(isset($filters["category"])){
            $category = $filters["category"];
        }
        if(isset($filters["subcategory"])){
            $subcategory = $filters["subcategory"];
        }
        $report = [];

        $report = FormData::leftJoin('form_instance_resolution_code_map', 'form_data.id', '=', 'form_instance_resolution_code_map.form_instance_id')
            ->leftJoin('form_resolution_code', 'form_instance_resolution_code_map.resolution_code_id', '=', 'form_resolution_code.id')
            ->leftJoin('form_user_form_instance', 'form_data.id', '=', 'form_user_form_instance.form_instance_id')
            ->leftJoin('users', 'form_user_form_instance.user_id', '=', 'users.id')
            ->when($since, function($query) use($since) {
                return $query->where('form_instance_resolution_code_map.updated_at', '>=', $since);
            }, function($query){
                $query->where('form_instance_resolution_code_map.updated_at', '>=', Self::$launch_date);
            })
            ->when($department, function($query) use($department){
                // $query->where('form_data.json_form_data->department', $department);
                $query->whereRaw("json_contains(`json_form_data`, '{\"department\" : \"$department\"}')");
            })
            ->when($category, function($query) use($category){
                // $query->where('form_data.json_form_data->category', $category);
                $query->whereRaw("json_contains(`json_form_data`, '{\"category\" : \"$category\"}')");
            })
            ->when($subcategory, function($query) use($subcategory){
                // $query->where('form_data.json_form_data->subcategory', $subcategory);
                $query->whereRaw("json_contains(`json_form_data`, '{\"subcategory\" : \"$subcategory\"}')");
            })
            ->select('form_data.form_data', 'form_resolution_code.resolution_code', 'form_data.created_at as submitted_at', 'form_instance_resolution_code_map.updated_at as resolved_at', \DB::raw('CONCAT(users.firstname," ",users.lastname) AS closed_by') )
            ->get()
            ->each(function($form_data){
                $unserialized_form_data = unserialize($form_data->form_data);
                foreach ($unserialized_form_data as $key => $value) {
                    $form_data->$key = $value;
                }
                unset($form_data->form_data);
                unset($form_data->form_id);
            });

        return $report;
    }

}

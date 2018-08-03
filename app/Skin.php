<?php

namespace App;

class Skin 
{
    public static function getSkin($id)
    {
		$parrentBanner = env('BANNER');
		$banner ="";
		
		if($parrentBanner=="FGL"){
			
			switch($id){
				case 1: 
					$banner = "sportchek";
					break;
				case 2: 
					$banner = "atmosphere";
					break;
				default:
					$banner = "sportchek";
					break;
			}
		}

		if($parrentBanner=="Marks"){
			switch($id){
				case 1: 
					$banner = "marks";
					app()->setLocale('en');
					break;
	
				case 2: 
					$banner = "l'equipeur";
					app()->setLocale('fr');
					break;
	
				default:
					$banner = "marks";
					app()->setLocale('en');
					break;
	
			}			
		}



    	return '<link rel="stylesheet" type="text/css" href="/css/skins/'.$banner.'/skin.css">';
    }
}

<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model {
	// protected $table = 'sites';
	 use HasFactory;
	
	protected $fillable = ['site_name', 'near', 'site_description', 'site_access', 'site_wind_directions', 'lat', 'lng', 'created_by',
		'updated_by', 'published', 'w3w', 'updated_at' ];

		static function getSiteList() {
			$sites = Site::where('published', 1)
			->orderBy('site_name')
			->get();
	 
			return $sites;
		}

		static function sayTrue() {
			return true;
		}
		// static function all() {
		// 	$sites = Site::where('published', 1)
		// 	->orderBy('site_name')
		// 	->get();
	 
		// 	return $sites;
		// }
}


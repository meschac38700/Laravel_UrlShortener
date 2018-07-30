<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    public static function getUniqueShortUrl()
	{
		$shortened = str_random(5);
		$shortened_already_exist = self::whereShortenedUrl($shortened)->first();
		if( $shortened_already_exist )
		{
			self::getUniqueShortUrl();
		}
		return $shortened;
	}
	
}

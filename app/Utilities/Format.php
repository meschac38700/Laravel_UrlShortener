<?php namespace App\Utilities;

class Format
{

	public static function value($oldValue, $p_value )
	{
		if (empty( $oldValue ) )
		{
			if( empty( $p_value ) )
			{
				return "";
			}
			return $p_value;
		}
		return $oldValue;
	}
}
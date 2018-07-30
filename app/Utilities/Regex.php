<?php namespace App\Utilities;

class Regex
{
	

	/**
	 * Validation of a URL, however it validates a URL 
	 * if its extension of domain is 
	 * of length min 2 and max 3! example: .fr or .com or .org etc ...
	 * @param  [string] $p_url à valider
	 * @return [boolean]  Si p_url valide return true else return false
	 */
	public static function validUrl( $p_url )
	{
		$pattern = "%((https?|ftp):\/\/)?(www\.)?[a-z0-9$&?=\*\+\/_-]+\.[a-z]{2,3}(\/[a-z0-9\/\?=&_-]+)?%i";

		$valid = preg_match($pattern, $p_url, $matches);
		// Si on matche quelque chose dans l'url donnée
		if( ! empty( $matches ) )
		{
			// Si l'url matchée est égale à l'url donnée
			if($matches[0] == $p_url )
			{
				//Alors url valide !
				return true;
			}
		}
		return false;
	}

	/**
	 * insert the value of a given field and the field name in the text 
	 * that contains ' :attribute '
	 * use regex to replace ' :attribute ' by a given value
	 * @param  [String] $text      the error text
	 * @param  [String] $fieldName name of the field 
	 * @param  [String] $value     the bad value that user given
	 * @return [String] 		   error message contains the name of the field 
	 *                             and the value that user given
	 */
	public static function replaceAttributeTextToFieldName($text, $fieldName, $value)
	{
		$pattern = "%\:[a-z]+%i";
		$new_text = preg_replace($pattern, $value, $text);
		return $new_text;
	}
}
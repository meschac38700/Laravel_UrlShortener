<?php namespace App\Utilities;

class Regex
{
	

	/**
	 * Validation of a URL, however it validates a URL if its extension of domain is 
	 * of length min 2 and max 3! example: .fr or .com or .org etc ...
	 * @param  [string] $p_url à valider
	 * @return [boolean]       Si p_url valide return true else return false
	 */
	public static function valideUrl( $p_url )
	{
		$pattern = "%((https?|ftp):\/\/)?(www\.)?[a-z$&?=\*\+\/_-]+\.[a-z]{2,3}(\/[a-z0-9\/\?=&_-]+)?%i";

		$valid = preg_match($pattern, $p_url, $matches);
		// Si on matche quelque chose dans l'url donnée
		if( ! empty( $matches ) )
		{
			// Si la chose matchée est égale à l'url donnée
			if($matches[0] == $p_url )
			{
				//Alors url valide !
				return true;
			}
		}
		return false;
	}
}
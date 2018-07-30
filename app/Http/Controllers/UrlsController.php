<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Url;
use App\Utilities\Regex;
class UrlsController extends Controller
{
    public function create()
    {
    	return view('pages.index');
    }

    public function store(Request $req)
    {
    	$url_post = $req->get('url');
	
		// Valider url
		if( Regex::validUrl($url_post) )
		{
			
			$new_url =$this->getRecordForUrl( $url_post );
			return view('pages.result')->withUrlExist($new_url);
		}
		else
		{
			$msg_error = Regex::replaceAttributeTextToFieldName(
								\Lang::get('validation')['url'],
								'url',
								$url_post
						);
			$error = [
				"http_response_code" => 401,
				"message" => $msg_error, // message d'erreur
				"url" => $url_post // afin de remplir le champs url
			];
			return redirect()->back()->withErrors((object) $error);
		}
    }

    public function show( Request $req, $shortUrl )
    {
    	//request sql search shortUrl to the DB
    	// throw exception that is manage in file App\Exceptions\Handler.php
		$url = Url::whereShortenedUrl($shortUrl)->firstOrFail();
		
		return redirect($url->original_url);
    }

    /**
     * [getRecordForUrl description]
     * Verifier si l'url a deja été  raccourcie si oui la retourner tout de suite
     * sinon créer une nouvelle short url et la retourner
     * @param  [type] $p_url [description]
     * @return [type]        [description]
     */
    private function getRecordForUrl( $p_url )
    {
    	try
		{
			// firstOrCreate(array(condition), array(paramForCreation)) 
			return Url::firstOrCreate( 
									   [ "original_url"=>$p_url ], 
									   [ "shortened_url"=>Url::getUniqueShortUrl() ]
									 );
		}
		catch(\Exception $e)
		{
			$error = [
				"http_response_code" => 500,
				"response" => false,
				"comment" => "Error to create a shortened url ! please try again "
			];
			return redirect('pages.error', compact("error"));
		}
    }
}

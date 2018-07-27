<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
use App\Url;
use App\Utilities\Regex;
Route::get('/', function (Request $req ) {
    return view('pages.index');
});

Route::post('/', function(Request $req )
{
	$url_post = $req->get('url');
	
	// Valider url
	if( Regex::validUrl($url_post) )
	{
		// Verifier si l'url a deja été  raccourcie si oui la retourner tout de suite
		$url_exist = Url::where('original_url', $url_post )->first();
		if( $url_exist )
		{
			return view('pages.result')->withUrlExist($url_exist);
		}
		
		// sinon créer une nouvelle short url et la retourner
		try
		{
			$new_url = Url::create([
					'original_url'  => $url_post,
					'shortened_url' =>  Url::getUniqueShortUrl()
			]);

			return view('pages.result')->withUrlExist($new_url);

		}
		catch(\Exception $e)
		{
			$error = [
				"http_response_code" => 500,
				"response" => false,
				"comment" => "Error to create a shortened url ! please try again "
			];
			return view('pages.error', compact("error"));
		}
	}
	else
	{
		$msg_error = Regex::replaceAttributeTextToFieldName(
							Lang::get('validation')['url'],
							'url',
							$url_post
					);
		$error = [
			"http_response_code" => 401,
			"message" => $msg_error, // message d'erreur
			"url" => $url_post // afin de remplir le champs url
		];
		return view('pages.index')->withErrors((object) $error);
	}
});



Route::get('/{shortUrl}', function( $shortUrl)
{
	//request sql search shortUrl to the DB
	$url = Url::whereShortenedUrl($shortUrl)->first();
	if( !$url )
	{
		return redirect('/');
	}
	return redirect($url->original_url);
});
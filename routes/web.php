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

Route::get('/', function (Request $req ) {
    return view('pages.index');
});

Route::post('/', function(Request $req )
{
	$url_post = $req->get('url');
	// Valider url
	$validation = Validator::make(['url'=>$url_post], ['url'=>'required|url' ])->validate();
	/*if( $validation ->fails() )
	{
		dd('Failed');
	}*/
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
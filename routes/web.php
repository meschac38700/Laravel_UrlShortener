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
Route::get('/', function (Request $req ) {
    return view('pages.index');
});

use App\Url;
Route::post('/', function(Request $req )
{
	$url_post = $req->get('url');
	// Valider url
	// Verifier si l'url a deja été  raccourcie si oui la retourner tout de suite
	$url_exist = Url::where('original_url', $url_post)->first();
	if( $url_exist )
	{
		return view('pages.result')->withUrlExist($url_exist);
	}
	// sinon créer une nouvelle short url et la retourner
	dd($url_post);
});

Route::get('/{shortUrl}', function( $shortUrl)
{
	$url = Url::whereShortenedUrl($shortUrl)->first();
	if( !$url )
	{
		return redirect('/');
	}	
	else
	{
		return redirect($url->original_url);
	}
});
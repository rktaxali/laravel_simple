<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/', function () {
    return view('welcome');
});



Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/about', function () {
	//$articles = App\Models\Article::all();   // get all articles 
	//$articles = App\Models\Article::paginate(2);   // get all articles, paginate with 2 items per page
	//$articles = App\Models\Article::take(3)->get();  // get first 3 articles 
	//$articles = App\Models\Article::latest()->get();   // get all articles in descending order of created_at
	//$articles = App\Models\Article::latest('updated_at')->get();   // get all articles in descending order of updated_at

	$articles = App\Models\Article::take(3)->latest('updated_at')->get();   // latest 3 articles based on updated_at field
	

	return view('about',
				[
					'articles'=>$articles,
				]

			);
});


// Called when url contains articles but not articles/{{articleID}}
/* Route::get('/articles', function () {
	$articles = App\Models\Article::paginate(2);    // paginate with 2 articles per page
	return view('articles', ['articles'=>$articles,	] );
});
 */
use App\Http\Controllers\ArticlesController;
Route::get('/articles', 'App\Http\Controllers\articlesController@index');
Route::post('/articles', 'App\Http\Controllers\articlesController@store');
//Route::get('/articles/create', 'App\Http\Controllers\articlesController@create');  // note /articles/{article} must be at the end

Route::get('/articles/create', [ArticlesController::class, 'create']);  
// Note: This method requires use App\Http\Controllers\ArticlesController; to be specified prior to executing this command

Route::get('/articles/{article}', 'App\Http\Controllers\articlesController@show');
Route::get('/articles/{article}/edit', 'App\Http\Controllers\articlesController@edit');
Route::put('/articles/{article}', 'App\Http\Controllers\articlesController@update');



/***
 * NOTE: In the following Route declaration, the code to handle data is 
 *       defined through a closure function()
 *       This works fine for a small project, however, for most projects, it is 
 *       hadnled through a controller (we define a controller and a method to call)
 *     The controller method is shown after the 'closure' method
 */


// called as http://127.0.0.1:8000/posts/145
// To pass the second parameter (e.g. 145) as $postID, include it as parameter to function()
Route::get('/posts_old/{post}', function ($postID) {
	
	// if we want to use $postID to fetch post data from database, we can 
	// make that call here and pass the result to view, 
	// 
	
	// Assuming postData is from a table
	$postData = [1=>'This is first Post',
	             2 => 'This is second post'
		             ];
	
	if (array_key_exists($postID, $postData))
	{
		$postInfo =    $postData[$postID];
		
	}
	else
	{
		$postInfo = 'Undefined post';
		
		// or we can display laravel abort() function for '404'
		abort(404);
	}
		

    return view('posts',
		['postID'=>$postID,
		 'postInfo'=>$postInfo,
		]
	
	);
});


//Route::get('/posts/{post}', 'postsController@show');  // Does not work in version 8. Need to use fully qualified path
Route::get('/posts/{post}', 'App\Http\Controllers\postsController@show');

Route::get('/test', function () {
	// request variable passed through url, e.g. http://127.0.0.1:8000/test?name=Ravi&age=60
	$name = request('name');
	$age = request('age');
	$boldname = '<strong>Raja Bold</strong>';
	
	// send second parameter contains variables to be sent to the view file
    return view('test',[
						'name' => $name,
						'age' => $age,
						'boldname' => $boldname,
						]
	
	);
});

Route::get('/test2', function () {
	// request variable passed through url, e.g. http://127.0.0.1:8000/test?name=Ravi&age=60
	$name = request('name')?request('name') : 'Ravi Taxali' ;
	$age = request('age');
	$boldname = '<strong>Raja Bold Test 2</strong>';
	
	// send second parameter contains variables to be sent to the view file
    return view('test2',[
						'name' => $name,
						'age' => $age,
						'boldname' => $boldname,
						]
	
	);
});


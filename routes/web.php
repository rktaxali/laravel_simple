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
    return view('about');
});


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


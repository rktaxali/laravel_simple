<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;  // required to use DB class 

use App\Models\Post;	// To use the Post.php model available in app/models/Post.php

class postsController extends Controller
{
	public function show($postID)
	{
		// if we want to use $postID to fetch post data from database, we can 
		// make that call here and pass the result to view, 
		// 
	
		// Uses the DB object 
		$post = DB::table('posts')->where('postID', $postID)->first();
	/* 	
		// To use the Post mode 
		$post = Post::where('postID', $postID)->first();  // (little cleaner that DB)
		if (! $post)
		{
			abort(404);
		}
		else
		{
			return view('posts',['post'=>$post]);
		}
 */

	 // replace first() with firstOrFail()  to automatically go the fail() route if the query does not return a result
	 /* 
	 $post = Post::where('postID', $postID)->firstOrFail();  // (little cleaner that DB)
	 return view('posts',['post'=>$post]);
 	*/
	 // or the above two lines can be merged into one 
	 return view('posts',
				 ['post'=>Post::where('postID', $postID)->firstOrFail()]
		);

	}
}

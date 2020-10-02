<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller
{
    //
    public function show(Article $article)
    {
      // $article = Article::find($id);  // Not required if we use show(Article $article) instead of show($id)
      // NOTE: This will work only for the primary key for the Article model. If something else is passed, 
      //       e.g. slug, we need to get primary key from that slug
       
       // to display the fetched article, we need a view page
       // either we can use 
       //   return view('article',['article'=>$article]);
       // alternativley, we can have a separate folder for articles and different views
       // for show, edit, add, etc. 
       // let is try the second method
       return view('articles.show',['article'=>$article]);
    }

    // display all articles on articles.blade.php
    public function index()
    {
        // fetch articles through paginate with 2 articles/page
        $articles = Article::paginate(2);
       return view('articles.index',['articles'=>$articles]);  // view file: articles/index.blade.php
    }

    

    public function store_old()
    {
        // stores the data submitted through create()
        
        // validate data. All fields are required 
        request()->validate([
            'title' => 'requried',
            'excerpt' => 'required',
            'body' => 'required'
        ]);

        $article = new Article();
        $article->title = request('title');
        $article->body = request('body');
        $article->excerpt = request('excerpt');
        $article->save();
        return redirect('/articles');

    }

    
    public function store(Request $request)
    {
        // stores the data submitted through create()

        $validatedData = $request->validate([
            'title' => ['required','unique:articles',  'max:255'],
            'excerpt' => ['required'],
            'body' => ['required'],
        ]);

        /* 
        // validate data. All fields are required 
        request()->validate([
            'title' => 'requried',
            'excerpt' => 'required',
            'body' => 'required'
        ]);
  */

        $article = new Article();
        $article->title = $request->input('title'); 
        $article->body = $request->input('body'); ;
        $article->excerpt = $request->input('excerpt'); ;
        $article->save();
        return redirect('/articles');

    }

    public function edit(Article $article)
    {
       // $article = Article::find($id);
        return view('articles.edit',['article'=>$article]);
    }

    public function update($id, Request $request) 
    {
       
        $validatedData = $request->validate([
            'title' => ['required','unique:articles',  'max:255'],
            'excerpt' => ['required'],
            'body' => ['required'],
        ]);

        $article = Article::find($id);
        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');
        $article->save();
        return redirect('/articles/' . $article->id);
      }

    public function create()
    {
        // persist the edit() resource
        return view('articles.create');
        
    }

    public function destroy()
    {
        // delete an existing resource 
    }
}

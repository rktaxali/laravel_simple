<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;

class ArticlesController extends Controller
{

    public function index(Request $request)
    {
        $articles = null;
        $tagname = null;
        if (! empty($request->input('tag')))
        {
            $view = 'articles.all_articles';
            $tagname = $request->input('tag');
            $tag =  Tag::where('name',$request->input('tag'))->first();
            if (! empty($tag))
            {
                $articles = $tag->articles->all();
            }
        }
        else
        {
            // fetch articles through paginate with 2 articles/page
            //   $articles = Article::all(); //       
        $articles =  Article::paginate(2);
        $view = 'articles.index';
        }
        
    return view($view,['articles'=>$articles, 'tagname'=>$tagname]);  // view file: articles/index.blade.php
    }



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
        $validation  = $this->validateArticle($request);

        $data = $request->only(['body', 'title','excerpt'])  ;
        $article = new Article( $data);
        // or access request data using input()
        /*
            $article = new Article(['body'=>$request->input('body'),
                                    'title'=>$request->input('title'),
                                    'excerpt'=>$request->input('excerpt'),
                                    ] );
        */

        $article = new Article( $data);
        $article->user_id = 5;   // currently hardcoded, later we can use ID of the authenticated user 
        $article->save();
        
        if (! empty($request->input('tags')))
        {
            // create tags (records in article_tag table for the passed tags, i.e. $request->input('tags')
            $article->tags()->attach($request->input('tags')); 
        }
        return redirect('/articles');
    }

    public function validateArticle(Request $request)
    {
        return $request->validate([
            'title' => ['required','unique:articles',  'max:255'],
            'excerpt' => ['required'],
            'body' => ['required'],
            'tags' => 'exists:tags,id',
        ]);
    }
    

    public function edit(Article $article)
    {
       // $article = Article::find($id);
        return view('articles.edit',['article'=>$article]);
    }

    public function update($id, Request $request) 
    {
    

        $this->validateArticle($request);

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
        return view('articles.create',
                        [
                            'tags'=>Tag::all(),  // Fet all tags from the Tag model
                        ]
                    );
    }

    public function destroy()
    {
        // delete an existing resource 
    }
}

@extends ('layouts.master')
<!-- next secction will insert the stylesheet at @yield('head') in mater.blade.php -->
@section ('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
@endsection

@section ('content')



<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
			<div class="title">
                <h2>Edit Article</h2>
            </div>

            <form method="POST" action="/articles/{{$article->id}}">
                <!-- if @csrf is not used, displays 419 | Page Expired error message -->
                @csrf
                @method('PUT')     <!-- converts POST request to PUT -->
                <div class="field">
                    <lavel class="label" for="title">Title</Label>

                    <div class="control">
                            <input class= "input @error('title') is-danger @enderror " 
                                type="text"
                                name="title" 
                                id="title"
                                value="{{$article->title}}"
                                >
                            @error ('title')
                                <p class="help is-danger">{{ $errors->first('title') }}</p>
                            @enderror  
                               
         
                    </div>
                </div>
                
                <div class="field">
                    <label class ="label" for="excerpt">Excerpt</label>
                    <div class = "control">
                        <textarea class="textarea" name="excerpt" 
                            id="excerpt" >{{$article->excerpt}}</textarea>
                    </div>
                </div>
                
                <div class="field">
                    <label class ="label" for="body">Body</label>
                    <div class = "control">
                        <textarea name="body" 
                        class="textarea"
                            id="body" >
                            {{$article->body}}
                        </textarea>
                    </div>
                </div>  

                <div class="field is-grouped">
                    <div class = "control">
                        <button class="button is-link" type="submit">
                            Submit
                        </button>
                    </div>
                </div>  
                
                
            </form>
            
		</div>
		
	</div>
</div>

@endsection

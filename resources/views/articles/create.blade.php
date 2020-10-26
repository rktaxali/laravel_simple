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
                <h2>New Article</h2>
            </div>

            <form method="POST" action="/articles">
                <!-- if @csrf is not used, displays 419 | Page Expired error message -->
                @csrf
                <div class="field">
                    <lavel class="label" for="title">Title</Label>

                    <div class="control">
                            <input class= "input @error('title') is-danger @enderror " 
                                type="text"
                                name="title" 
                                id="title"
                                value="{{old('title')}}"
                                >
                            @error ('title')
                                <p class="help is-danger">{{ $errors->first('title') }}</p>
                            @enderror  
                               
         
                    </div>
                </div>
                
                <div class="field">
                    <label class ="label" for="excerpt">Excerpt</label>
                    <div class = "control">
                        <textarea class="textarea   @error('excerpt') is-danger @enderror " 
                            name="excerpt"
                            id="excerpt" >
                        {{old('excerpt')}}
                        </textarea>
                        @error ('excerpt')
                                <p class="help is-danger">{{ $errors->first('excerpt') }}</p>
                        @enderror   
                    </div>
                </div>
                
                <div class="field">
                    <label class ="label" for="body">Body</label>
                    <div class = "control">
                        <textarea
                                class="textarea   @error('body') is-danger @enderror "
                                name="body" 
                                id="body" >
                            {{old('body')}}
                        </textarea>
                        @error ('body')
                                <p class="help is-danger">{{ $errors->first('body') }}</p>
                        @enderror                              
                    </div>
                </div>  

                <div class="field">
                    <label class ="label" for="body">Tags</label>
                    <div class = "control">
                        <select  name="tags[]"
                                multiple
                                >
                            @foreach ($tags as $tag)
                                <option value ="{{$tag->id}}">{{$tag->name}} </option>
                            @endforeach
                        </select>

                        @error ('tags')
                                <p class="help is-danger">{{ $errors->first('tags') }}</p>
                        @enderror                              
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

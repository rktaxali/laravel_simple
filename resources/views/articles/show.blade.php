@extends ('layouts.master')
@section ('content')

<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
			<div class="title">
                <h2>{{$article->title}}</h2>
                {{$article->body}}
                <p>
                @foreach ($article->tags as $tag)
                    <a href="/articles?tag={{$tag->name}}">{{$tag->name}}</a>
                    <a href="{{route('articles.index',['tag'=>$tag->name])}}">{{$tag->name}}</a>
                @endforeach
                </p>
        </div>
        <div>
            <a href="/articles"  class="button">Back to Articles</a>
        </div>
		
	</div>
</div>

@endsection

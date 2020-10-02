@extends ('layouts.master')
@section ('content')

<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
			<div class="title">
                <h2>{{$article->title}}</h2>
                {{$article->body}}
        </div>
        <div>
            <a href="/articles"  class="button">Back to Articles</a>
        </div>
		
	</div>
</div>

@endsection

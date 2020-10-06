@extends ('layouts.master')
@section ('content')

<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
			<div class="title">
                <h2>Articles</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul class="style1">
                            @foreach ($articles as $article) 
                            <li class="first">
                                    <h3><a href="/articles/{{$article->id}}">{{$article->title}}</h3>
                                    <p><a href="/articles/{{$article->id}}">{{$article->excerpt}}</a></p>
                                </li>
                            @endforeach
                    </ul>
                </div>
            </div>

            <!-- required to display pagination links -->

            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                         {!! $articles->links() !!}
                    </div>
                </div>
            </div> 

		</div>
		
	</div>
</div>

@endsection

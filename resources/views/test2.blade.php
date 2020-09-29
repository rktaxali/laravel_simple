@extends ('layouts.master')  <!-- refers to views/layouts/master.blade.php -->
@section('title','Test Page')
@section('content')
           

            <div class="content">
                <div class="title m-b-md">
                    Laravel Test
                </div>
				
				<div>
					Name: <span>{{$name}}</span><br>
					Age: <span>{{$age}}</span><br>
					Bold Name &nbsp;&nbsp; {{ $boldname }}<br>
					Bold Name &nbsp;&nbsp; {!! $boldname !!}<br>
		
				</div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                   
                </div>
            </div>
@endsection

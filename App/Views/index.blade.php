@extends('layout')

@section('content')
	  @foreach ($posts as $post)
      <div class="row">
        <div class="col-md-12">
          <h2>{{ $post->title }}</h2>
          <p>{!! $post->post !!}</p>
        </div>
      </div>
	  @endforeach
	  {!! $paginator !!}
@endsection
	  

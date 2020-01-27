@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <h1>Show Post: <a href="{{ route('posts.index') }}">{{ $post->title }}</a></h1>
    </div>
    <div class="col-12">
            <div>
                <h4>Title</h4>
                <p>{{ $post->title }}</p>
            </div>

            <div>
                <h4>Autore</h4>
                <p>{{ $post->author }}</p>
            </div>

            <div>
                <h4>Categoria</h4>
                <p>{{ $post->category->title }}</p>
            </div>

            <div>
                <h4>Descrizione</h4>
                <p>
                    {{ $post->postInformation->description }}
                </p>
            </div>

            <div>
                <h4>Tag</h4>
                @foreach ($post->tags as $tag)
                  <p>{{$tag->title}}</p>
                @endforeach


            </div>

    </div>

</div>



@endsection

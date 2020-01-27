@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <h1>Create Post: </h1>
    </div>
    <div class="col-12">
        <form action="{{ route('posts.store') }}" method="post">
            @csrf
            @method('POST')

            <div class="form-group">
                <label>Title</label>
                <input value="" class="form-control" name="title" type="text" placeholder="Inserisci un titolo" />
            </div>

            <div class="form-group">
                <label>Autore</label>
                <input value="" class="form-control" name="author" type="text" placeholder="Inserisci un autore" />
            </div>

            <div class="form-group">
                <label>Categoria</label>
                <select class="form-control" name="category_id">
                    <option>---</option>
                    {{-- @foreach($post->categories as $category)

                        <option {{ $post->category->id == $category->id ? 'selected' : '' }} value="{{ $category->id }}"></option>

                    @endforeach --}}
                </select>
            </div>

            <h3>Post Information Data</h3>
            <div class="form-group">
                <label>Descrizione</label>
                <textarea class="form-control" name="description" type="text" placeholder="Inserisci una descrizione">
                </textarea>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Crea" />
            </div>
        </form>
    </div>

</div>



@endsection

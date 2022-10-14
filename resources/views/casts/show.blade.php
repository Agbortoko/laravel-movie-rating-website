@extends('layouts.app')


@section('content')


   <div class="row justify-content-center">
    <div class="col-md-4">

        <div class="card">

            <img loading="lazy" src="{{ $cast->image }}" alt="{{ $cast->name }}" class="card-image-top">

            <div class="card-body">
                <h1>{{ $cast->name }}</h1>
                <p>All Movies of {{ $cast->name }}</p>


                <ul class="list-group list-group-flush">

                    @unless(count($cast->movies)==0)

                    @foreach($cast->movies as $movie)
                    <li class="list-group-item">
                        <a href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }} </a>
                    </li>
                        
                    @endforeach

                    @else

                    <li class="list-group-item">
                        <p>No movies found</p>
                    </li>
                    
                    @endunless
                </ul>
            </div>

            <div class="card-footer">
                <form action="{{ route('casts.destroy', $cast->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        Delete
                    </button>
                </form>
            </div>
            
        </div>

    </div>
   </div>



@endsection
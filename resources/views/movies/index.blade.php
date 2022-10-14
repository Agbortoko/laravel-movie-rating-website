@extends('layouts.app')


@section('content')


    <h1>All Movies 
        @auth
        <a href="{{ route('movies.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
        @endauth
    </h1>

    <div class="row my-5 g-3 align-items-stretch">


    @unless(count($movies) == 0)

        @foreach($movies as $movie)
        
    
            <div class="col-lg-2 col-md-4 col-sm-6">
                <a href="{{ route('movies.index') }}/{{ $movie->id }}" class="text-decoration-none text-dark">

                {{-- <div class="card-image-top" style="background-image: url('{{ $movie->image }}'); background-position: center; height: 200px;"> 
                </div> --}}

                <div class="card h-100">

                    <img src="{{ $movie->image }}" alt="{{ $movie->title }}" class="card-image-top img-fluid" />

    
                    <div class="card-body">
                        <h6 class="fw-bold">{{ $movie->title }}</h6>
                        <div class="text-danger">
                            @php
                                $rating = 0;
                            @endphp
                            @while($rating < $movie->rating_star)
                                <i class="fas fa-star"></i>
                                @php
                                    $rating++;
                                @endphp
                            @endwhile
                        </div>

                        <small>
                            <p>
                                {{ Str::limit($movie->description, 60) }}
                            </p>
                        </small>

                        <time class="d-block"> 
                                {{ Carbon\Carbon::parse($movie->created_at)->diffForHumans()}}
                        </time>
                    </div>
                </div>
                </a>

            </div>
       
        @endforeach

    @else
            <div class="col-md-6 mx-auto">
                <div class="card p-3">
                    <div class="alert alert-danger text-center mb-0">
                        <p class="mb-0 lead">No Movies</p>
                    </div>
                </div>
            </div>
            
        
    @endunless

        </div>



@endsection
@extends('layouts.app')


@section('content')

<div class="row">

    <div class="col-md-6 mx-auto">

        <div class="card p-0">
         
         <img src="{{ $movie->image }}" class="img-fluid" alt="" loading="lazy">
     
             <div class="card-body">
     
                 <h1 class="mt-4">{{ $movie->title }}</h1>
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
                         {{ $movie->description }}
                     </p>
                 </small>
     
                 <h3>
                     Cast 
                     @auth
                     <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                         <i class="fas fa-plus"></i>
                       </button>
                    @endauth
                       
     
                 </h3>
     
                 <ul class="list-group list-group-flush">
                    @unless(count($movie->casts) == 0)

                    @foreach($movie->casts as $cast)
                     <li class="list-group-item">{{ $cast->name }} - 
                         <span class="text-muted"><em>{{ $cast->pivot->role }}</em></span>
                         @auth
                         <form action="{{ route('movie_cast_destroy', [$movie->id, $cast->id]) }}" method="POST">
                             @csrf
                             @method('delete')
                             <button type="submit" class="btn btn-link text-danger">Delete</button>
                         </form>
                         @endauth
                     </li>
                     @endforeach

                     @else

                     <li class="list-group-item">
                         <p>No Casts Found</p>
                     </li>

                     @endunless
                   </ul>
     
     
                   <h3 class="mt-5">Comments</h3>
                  
                   {{-- <p>No comments</p> --}}
     
     
                   <ul class="list-group list-group-flush mb-5">


                    @unless(count($movie->comments) == 0)

                    @foreach($movie->comments as $comment)

                    <li class="list-group-item"><span class="fw-bold">{{ $comment->user->name }}: </span> {{ $comment->content }}
                        @auth
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-link text-danger">Delete</button>
                        </form>
                        @endauth
                    </li>
                     @endforeach

                     @else

                        <li class="list-group-item">
                            <p>No Comments</p>
                        </li>
                     
                     @endunless
                   </ul>
                    
                   
                     
                   </ul>
                
                   @auth
                   <form action="{{ route('movies.comments.store', $movie->id) }}" method="POST"> 
                         @csrf
                         <input type="text" class="form-control mb-3" placeholder="Say Something" name="comment" id="">
     
                         <button type="submit" class="btn btn-primary">Comment</button>
                   </form>
                   @endauth
     
             </div>
     
             @auth
             <div class="card-footer">
                 <form action="{{ route('movies.destroy', $movie->id) }}" method="POST">
                    @csrf
                    @method('delete')
                     <button type="submit" class="btn btn-link">Delete</button>
                 </form>
             </div>
             @endauth
        </div>

    </div>



</div>

   
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">New Cast</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="row">

                <div class="col-md-6">
                    <h4>Cast Role</h4>
                    <form action="{{ route('movie_cast_store', $movie->id) }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Actor Name</label>
                            <select name="cast_movie_name" class="form-select">
                                <option value="" disabled selected> Choose Cast </option>

                                @unless(count($casts) == 0)

                                    @foreach($casts as $cast)
                                    
                                        <option value="{{ $cast->id }}" >{{ $cast->name }}</option>

                                    @endforeach

                                @endunless
                            </select>

                        </div>

                        <div class="form-group mb-3">
                            <label for="">Role</label>
                            <input type="text" class="form-control" name="cast_movie_role" id="">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <div class="col-md-6">
                    <h4>New Role</h4>
                    <form action="{{ route('casts.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Actor Name</label>
                            <input type="text" class="form-control" name="cast_name">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Actor Image</label>
                            <input type="text" class="form-control" name="cast_image">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>

            </div>
        </div>
        
        
      </div>
    </div>
  </div>
  



@endsection
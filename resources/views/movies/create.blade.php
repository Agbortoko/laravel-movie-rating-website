@extends('layouts.app')


@section('content')


   <div class="card p-0">

        <div class="card-body">

            <h1 class="mt-4">Add New Movie</h1>  

              <form action="{{ route('movies.store') }}" method="POST"> 
                  @csrf
                  <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control mb-3" placeholder="" name="title" id="">
                  </div>

                  <p class="text-danger">
                        @error('title')
                              {{ $message }}
                        @enderror
                  </p>

                  <div class="form-group">
                        <label for="image">Image</label>
                        <input type="text" class="form-control mb-3" placeholder="" name="image" id="">
                  </div>

                  <p class="text-danger">
                        @error('image')
                              {{ $message }}
                        @enderror
                  </p>

                  
                  <div class="form-group">
                        <label for="image">Rating stars</label>
                        <input type="text" class="form-control mb-3" placeholder="" name="rating_star" id="">
                  </div>

                  <p class="text-danger">
                        @error('rating_star')
                              {{ $message }}
                        @enderror
                  </p>

                  <div class="form-group">
                        <label for="description"> Description</label>
                        <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
                  </div>

                  <p class="text-danger">
                        @error('description')
                              {{ $message }}
                        @enderror
                  </p>
      

                    <button type="submit" class="btn btn-primary mt-2">Add Movie</button>
              </form>

        </div>

       
   </div>




@endsection
@extends('layouts.app')


@section('content')


   <div class="row justify-content-center">
    <div class="col-md-4">

        <div class="card">

            <img src="" alt="" class="card-image-top">

            <div class="card-body">
                <h1>Tony Stark</h1>
                <p>All Movies of Tony stark</p>


                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="#">Avengers </a>
                    </li>
                </ul>
            </div>

            <div class="card-footer">
                <form action="" method="POST">
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
<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MovieController extends Controller
{


    public function __construct(){
        $this->middleware('auth')->only(['create', 'store', 'destroy']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();

        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        
        $formFields = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'rating_star' => 'required',
            'description' => 'required'
        ]);

        $movie = Movie::create($formFields);

        return redirect()->route('movies.show', $movie->id);
        // return back()->with('message', 'Movie created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        $casts = Cast::all();
        return view('movies.show', compact('movie', 'casts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index');
    }


    
    public function movie_cast_store(Request $request, Movie $movie){
        
        $formFields = $request->validate([
            'cast_movie_name' => 'required',
            'cast_movie_role' => 'required'
        ]);

        $movie->casts()->attach($formFields['cast_movie_name'],['role' => $formFields['cast_movie_role']]);

        return back();
    }


    
    public function movie_cast_destroy(Movie $movie, Cast $cast){
        
        $movie->casts()->detach($cast->id);

        return back();
    }


}

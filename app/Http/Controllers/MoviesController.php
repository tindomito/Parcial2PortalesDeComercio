<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MoviesController extends Controller
{
    public function index(Request $request)
    {
        $moviesQuery = Movie::with(['rating', 'genres']);

        $searchParams = [
          's-title' => $request->query('s-title'),
          's-rating' => $request->query('s-rating'),
        ];

        if($searchParams['s-title']){
            $moviesQuery->where('title', 'like', '%'.$searchParams['s-title'].'%');
        }

        if($searchParams['s-rating']){
            $moviesQuery->where('rating_fk', '=', $searchParams['s-rating']);
        }

        $allMovies = $moviesQuery->paginate(2)->withQueryString();

        return view('movies.index', [
            'movies' => $allMovies,
            'ratings' => Rating::all(),
            'searchParams' => $searchParams,
        ]);
    }

    public function view(Movie $movie)
    {
        return view('movies.view',[
            'movie' => $movie
        ]);
    }

    public function create()
    {


        return view('movies.create',[
            'genres' => Genre::orderBy('name')->get(),
            'ratings' => Rating::all(),
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
             'title' => ['required','min:2'],
             'price' => 'required|numeric',
             'release_date' => 'required'
        ],[
            'title.required' => 'El título debe tener un valor',
            'title.min' => 'El título debe tener al menos :min caracteres',
            'price.required' => 'El precio debe tener un valor',
            'price.numeric' => 'El precio debe ser un valor numerico',
            'release_date.required' => 'la fecha debe tener un valor'
        ]);

        $input = $request->all();

        if($request->hasFile('cover')){
            $input['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $movie = Movie::create($input);
        $movie->genres()->attach($input['genre_id'] ?? [] );

        return redirect()
            ->route('movies.index')
            ->with('feedback.message', 'La película <b>'. e($input['title']) .'</b> se publicó exitosamente');

    }

    public function delete (int $id)
    {
        return view('movies.delete', [
            'movie' => Movie::findOrFail($id),
        ]);
    }

    public function destroy(int $id)
    {
        $movie = Movie::find($id);
        $movie->genres()->detach();
        $movie->delete($id);

        if($movie->cover){
            Storage::disk('public')->delete($movie->cover);
        }

        return redirect()
            ->route('movies.index')
            ->with('feedback.message', 'La película <b>'. e($movie->title) .'</b> se eliminó exitosamente');


    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', [
            'movie' => $movie,
            'ratings' => Rating::all(),
            'genres' => Genre::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, int $id)
    {
        $movie = Movie::find($id);
        $input = $request->except('_token'. '_method');
        $oldCover = $movie->cover;

        $request->validate([
             'title' => ['required','min:2'],
             'price' => 'required|numeric',
             'release_date' => 'required'
        ],[
            'title.required' => 'El título debe tener un valor',
            'title.min' => 'El título debe tener al menos :min caracteres',
            'price.required' => 'El precio debe tener un valor',
            'price.numeric' => 'El precio debe ser un valor numerico',
            'release_date.required' => 'la fecha debe tener un valor'
        ]);
        if($request->hasFile('cover')){
            $input['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $movie->update($input);
        $movie->genres()->sync($request->input('genre_id', []));

        if($oldCover && $request->hasFile('cover')){
            Storage::disk('public')->delete($oldCover);
        }

        return redirect()
            ->route('movies.index')
            ->with('feedback.message', 'La película <b>'. e($movie->title) .'</b> se actualizó exitosamente');

    }
}

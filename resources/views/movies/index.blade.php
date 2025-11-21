<?php
/** @var  \Illuminate\Database\Eloquent\Collection|\App\Models\Movie[] $movies */
/** @var  \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rating>| \App\Models\Rating[] $ratings  */
?>
<x-layout>
    <x-slot:title> listado de peliculas </x-slot:title>
    <h1 class="m-3">listado de peliculas</h1>
    @auth
        <p class="mb-3"> <a href="{{ route('movies.create') }}">Publicar una película</a> </p>
    @endauth

    <section class="mb-3">
        <h2>buscador</h2>
        <form action="{{route('movies.index')}}" method="GET">
            <div class="d-flex gap-3 align-items-end mb-3">
                <div class="">
                    <label for="s-title" class="form-label">Titulo</label>
                    <input type="search" name="s-title" id="s-title" class="form-control" value="{{$searchParams['s-title']}}">
                </div>
                <div>
                    <label for="s-rating" class="form-label">Clasificacion</label>
                    <select name="s-rating" id="s-rating" class="form-control">
                        <option value="">Todas</option>
                        @foreach($ratings as $rating)
                            <option value="{{$rating->rating_id}}" @selected($rating->rating_id == $searchParams['s-rating'])>
                                {{$rating->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </section>
    @if(!empty($searchParams['s-title']))
        <p class="mb-3 fst-italis">
            mostrando los resultados de la busqueda para el termino:
            <b>{{$searchParams['s-title']}}</b>
        </p>
    @endif
    <h2 class="visually-hidden">Peliculas</h2>
    @if ($movies->isNotEmpty())
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Precio</th>
                <th>Fecha de Estreno</th>
                <th>Géneros</th>
                <th>Clasificación</th>
                <th>Acciones</th>
            </tr>
            @foreach ($movies as $movie)
                <tr>
                    <td class="align-top" >{{ $movie->movie_id }}</td>
                    <td class="align-top" >{{ $movie->title }}</td>
                    <td class="align-top" >{{ $movie->price }}</td>
                    <td class="align-top" >{{ $movie->release_date }}</td>
                    <td class="align-top" >
                        @foreach ($movie->genres as $genre)
                            <span class="badge bg-secondary">{{ $genre->name }}</span>
                        @endforeach
                    </td>
                    <td class="align-top" >{{ $movie->rating->name }}</td>
                    <td class="align-top" >
                        <div class="d-flex gap-2">
                            <a
                                href="{{ route('movies.view', ['movie' => $movie->movie_id]) }}"
                                class="btn btn-primary"
                            >Ver</a>
                            @auth
                                <a
                                    href="{{ route('movies.edit', ['movie' => $movie->movie_id]) }}"
                                    class="btn btn-secondary"
                                >Editar</a>

                                <a
                                    href="{{ route('movies.delete', ['id' => $movie->movie_id]) }}"
                                    class="btn btn-danger"
                                >Eliminar</a>
                            @endauth

                        </div>
                    </td>
                </tr>
            @endforeach

        </thead>
    </table>
    {{$movies->links()}}
    @else
        <p>No se encontraron resultados con los criterios de busqueda ingresados</p>
    @endif
</x-layout>

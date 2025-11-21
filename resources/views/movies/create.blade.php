<?php
    /** \Illuminate\Support\ViewErrorBag $errors */
    /** \Illuminate\Support\Collection<int, \App\Models\Genre> $genres */
?>
<x-layout>

    <x-slot:title>Publicar una Pelicula</x-slot:title>

    <h1 class="mb-3" >Publicar una Pelicula</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            La informacion ingresada contiene errores.
            Por favor, revisá los campos y prbá de nuevo
        </div>
    @endif

    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control @error('title') is-invalid @enderror"
                @error('title') aria-invalid="true" aria-errormessage="error-title" @enderror
                value="{{ old('title') }}"
            >
            @error('title')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input
                type="text"
                id="price"
                name="price"
                class="form-control @error('price') is-invalid @enderror"
                @error('price') aria-invalid="true" aria-errormessage="error-price" @enderror
                value="{{ old('price') }}"
            >
            @error('price')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="release_date" class="form-label">Fecha de Estreno</label>
            <input
                type="date"
                id="release_date"
                name="release_date"
                class="form-control @error('release_date') is-invalid @enderror"
                @error('release_date') aria-invalid="true" aria-errormessage="error-release_date" @enderror
                value="{{ old('release_date') }}"
            >
            @error('release_date')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="synopsis" class="form-label">Sinopsis</label>
            <textarea name="synopsis" id="synopsis" class="form-control">{{ old('synopsis') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="rating_fk" class="form-label">Clasificación</label>
            <select
                name="rating_fk"
                id="rating_fk"
                class="form-control"
            >
                @foreach ($ratings as $rating)
                    <option
                        value="{{ $rating->rating_id }}"
                        @selected($rating->rating_id == old('rating_fk'))

                    >
                        {{ $rating->name }} ({{ $rating->abbreviation }})
                    </option>
                @endforeach
            </select>
            @error('rating_fk')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cover" class="form-label">
                Portada <span class="small" >(opcional)</span>
            </label>
            <input
                type="file"
                id="cover"
                name="cover"
                class="form-control @error('cover') is-invalid @enderror"
                @error('cover') aria-invalid="true" aria-errormessage="error-cover" @enderror
                value="{{ old('cover') }}"
            >
            @error('cover')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cover_description" class="form-label">
                Descripción de la Portada <span class="small" >(opcional)</span>
            </label>
            <input
                type="text"
                id="cover_description"
                name="cover_description"
                class="form-control @error('cover_description') is-invalid @enderror"
                @error('cover_description') aria-invalid="true" aria-errormessage="error-cover_description" @enderror
                value="{{ old('cover_description') }}"
            >
            @error('cover_description')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <fieldset class="mb-3">
            <legend>Géneros</legend>
            @foreach ($genres as $genre)
            <label class="me-3">
                <input
                    type="checkbox"
                    name="genre_id[]"
                    value="{{ $genre->genre_id }}"
                    @checked(in_array($genre->genre_id, old('genre_id', [])))
                >
                {{ $genre->name }}
            </label>
            @endforeach
        </fieldset>

        <button type="submit" class="btn btn-primary">Publicar</button>

    </form>

</x-layout>

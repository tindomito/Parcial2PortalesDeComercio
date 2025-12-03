<?php
    /** \Illuminate\Support\ViewErrorBag $errors */
    /** \Illuminate\Support\Collection<int, \App\Models\Category> $categories */
?>
<x-layout>

    <x-slot:title>Publicar un Evento</x-slot:title>

    <h1 class="mb-3" >Publicar un Evento</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            La informacion ingresada contiene errores.
            Por favor, revisá los campos y prbá de nuevo
        </div>
    @endif

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input
                type="text"
                id="name"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                @error('name') aria-invalid="true" aria-errormessage="error-name" @enderror
                value="{{ old('name') }}"
            >
            @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ticket_price" class="form-label">Precio Entrada</label>
            <input
                type="text"
                id="ticket_price"
                name="ticket_price"
                class="form-control @error('ticket_price') is-invalid @enderror"
                @error('ticket_price') aria-invalid="true" aria-errormessage="error-ticket_price" @enderror
                value="{{ old('ticket_price') }}"
            >
            @error('ticket_price')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Fecha</label>
            <input
                type="date"
                id="date"
                name="date"
                class="form-control @error('date') is-invalid @enderror"
                @error('date') aria-invalid="true" aria-errormessage="error-date" @enderror
                value="{{ old('date') }}"
            >
            @error('date')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
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
            <legend>Categorias</legend>
            @foreach ($categories as $category)
            <label class="me-3">
                <input
                    type="checkbox"
                    name="category_id[]"
                    value="{{ $category->category_id }}"
                    @checked(in_array($category->category_id, old('category_id', [])))
                >
                {{ $category->name }}
            </label>
            @endforeach
        </fieldset>

        <button type="submit" class="btn btn-primary">Publicar</button>

    </form>

</x-layout>

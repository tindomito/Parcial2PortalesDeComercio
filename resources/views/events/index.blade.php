<?php
/** @var  \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events */
/** @var  \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rating>| \App\Models\Rating[] $ratings  */
?>
<x-layout>
    <x-slot:title> Cartelera UFC </x-slot:title>
    
    <style>
        .events-header {
            background: linear-gradient(135deg, rgba(255, 0, 0, 0.1), rgba(204, 0, 0, 0.1));
            border: 1px solid rgba(255, 0, 0, 0.2);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .search-section {
            background: rgba(30, 30, 30, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .search-section h2 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: #ffffff;
        }
        
        .form-control,
        .form-select {
            background: rgba(20, 20, 20, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            border-radius: 8px;
        }
        
        .form-control:focus,
        .form-select:focus {
            background: rgba(30, 30, 30, 0.9);
            border-color: rgba(255, 0, 0, 0.5);
            color: #ffffff;
            box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.1);
        }
        
        .form-control option,
        .form-select option {
            background: #1a1a1a;
            color: #ffffff;
        }
        
        .btn-search {
            background: linear-gradient(135deg, #ff0000, #cc0000);
            border: none;
            color: #ffffff;
            padding: 0.5rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(255, 0, 0, 0.3);
        }
        
        .events-table {
            background: rgba(20, 20, 20, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        
        .events-table thead {
            background: linear-gradient(135deg, rgba(255, 0, 0, 0.2), rgba(204, 0, 0, 0.2));
        }
        
        .events-table th {
            color: #ffffff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 1rem;
            border: none;
        }
        
        .events-table td {
            color: rgba(255, 255, 255, 0.9);
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            vertical-align: middle;
        }
        
        .events-table tbody tr {
            transition: all 0.3s ease;
        }
        
        .events-table tbody tr:hover {
            background: rgba(255, 0, 0, 0.05);
        }
        
        .badge-category {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            margin-right: 0.3rem;
            display: inline-block;
            margin-bottom: 0.3rem;
        }
        
        .btn-action {
            padding: 0.4rem 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-view {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }
        
        .btn-view:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }
        
        .btn-edit {
            background: rgba(255, 165, 0, 0.2);
            color: #ffa500;
        }
        
        .btn-edit:hover {
            background: rgba(255, 165, 0, 0.3);
            color: #ffa500;
        }
        
        .btn-delete {
            background: rgba(255, 0, 0, 0.2);
            color: #ff4444;
        }
        
        .btn-delete:hover {
            background: rgba(255, 0, 0, 0.3);
            color: #ff4444;
        }
        
        .btn-publish {
            background: linear-gradient(135deg, #ff0000, #cc0000);
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-publish:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(255, 0, 0, 0.3);
            color: #ffffff;
        }
        
        .no-results {
            text-align: center;
            padding: 3rem;
            color: rgba(255, 255, 255, 0.6);
            background: rgba(30, 30, 30, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
        }
    </style>
    
    <div class="events-header">
        <h1 class="mb-3">Cartelera UFC</h1>
        @if(auth()->user()?->role === \App\Models\User::ROLE_ADMIN)
            <a href="{{ route('events.create') }}" class="btn-publish">+ Publicar un Evento</a>
        @endif
    </div>

    <section class="search-section">
        <h2>Buscador</h2>
        <form action="{{route('events.index')}}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="s-name" class="form-label">Nombre</label>
                    <input type="search" name="s-name" id="s-name" class="form-control" value="{{$searchParams['s-name']}}">
                </div>
                <div class="col-md-4">
                    <label for="s-rating" class="form-label">Clasificación</label>
                    <select name="s-rating" id="s-rating" class="form-select">
                        <option value="">Todas</option>
                        @foreach($ratings as $rating)
                            <option value="{{$rating->rating_id}}" @selected($rating->rating_id == $searchParams['s-rating'])>
                                {{$rating->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-search w-100">Buscar</button>
                </div>
            </div>
        </form>
    </section>
    
    @if(!empty($searchParams['s-name']))
        <p class="mb-3 text-white-50">
            Mostrando resultados para: <strong class="text-white">{{$searchParams['s-name']}}</strong>
        </p>
    @endif
    
    @if ($events->isNotEmpty())
        <div class="events-table">
            <table class="table table-dark mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Fecha</th>
                        <th>Categorías</th>
                        <th>Clasificación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->event_id }}</td>
                            <td><strong>{{ $event->name }}</strong></td>
                            <td>${{ $event->ticket_price }}</td>
                            <td>{{ $event->date }}</td>
                            <td>
                                @foreach ($event->categories as $category)
                                    <span class="badge-category">{{ $category->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $event->rating->name }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('events.view', ['event' => $event->event_id]) }}" class="btn btn-action btn-view">Ver</a>
                                    @if(auth()->user()?->role === \App\Models\User::ROLE_ADMIN)
                                        <a href="{{ route('events.edit', ['event' => $event->event_id]) }}" class="btn btn-action btn-edit">Editar</a>
                                        <a href="{{ route('events.delete', ['id' => $event->event_id]) }}" class="btn btn-action btn-delete">Eliminar</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{$events->links()}}
        </div>
    @else
        <div class="no-results">
            <p class="mb-0">No se encontraron resultados con los criterios de búsqueda ingresados</p>
        </div>
    @endif
</x-layout>

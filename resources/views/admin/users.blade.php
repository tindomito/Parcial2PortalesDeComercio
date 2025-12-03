<x-layout>

    <x-slot:title>Panel de Administración - Usuarios</x-slot:title>

    <style>
        .admin-header {
            background: linear-gradient(135deg, rgba(255, 0, 0, 0.1), rgba(204, 0, 0, 0.1));
            border: 1px solid rgba(255, 0, 0, 0.2);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .admin-header h1 {
            color: #ffffff;
            margin-bottom: 0.5rem;
        }
        
        .users-table-container {
            background: rgba(20, 20, 20, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        .users-table {
            margin-bottom: 0;
        }
        
        .users-table thead {
            background: linear-gradient(135deg, rgba(255, 0, 0, 0.2), rgba(204, 0, 0, 0.2));
        }
        
        .users-table th {
            color: #ffffff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 1rem;
            border: none;
        }
        
        .users-table td {
            color: rgba(255, 255, 255, 0.9);
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            vertical-align: middle;
        }
        
        .users-table tbody tr {
            transition: all 0.3s ease;
        }
        
        .users-table tbody tr:hover {
            background: rgba(255, 0, 0, 0.05);
        }
        
        .stats-card {
            background: linear-gradient(135deg, rgba(30, 30, 30, 0.8), rgba(20, 20, 20, 0.8));
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 2rem;
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 0, 0, 0.3);
            box-shadow: 0 10px 30px rgba(255, 0, 0, 0.1);
        }
        
        .stats-card h5 {
            color: #ffffff;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ff0000, #cc0000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .badge-role {
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .badge-admin {
            background: rgba(255, 0, 0, 0.2);
            color: #ff4444;
        }
        
        .badge-user {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.8);
        }

        .user-link {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .user-link:hover {
            color: #ff0000;
            text-decoration: underline;
            transform: translateX(5px);
        }

        .clickable-cell {
            cursor: pointer;
        }
    </style>

    <div class="admin-header">
        <h1>Panel de Administración - Usuarios</h1>
        <p class="text-white mb-0">Total de usuarios registrados: <strong>{{ $users->count() }}</strong></p>
    </div>

    @if($users->isEmpty())
        <div class="alert alert-info">
            No hay usuarios registrados en el sistema.
        </div>
    @else
        <div class="users-table-container">
            <table class="table table-dark users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Fecha de Registro</th>
                        <th>Última Actualización</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td class="clickable-cell">
                                <a href="{{ route('admin.user.details', $user->id) }}" class="user-link">
                                    <strong>{{ $user->name }}</strong>
                                </a>
                            </td>
                            <td class="clickable-cell">
                                <a href="{{ route('admin.user.details', $user->id) }}" class="user-link">
                                    {{ $user->email }}
                                </a>
                            </td>
                            <td>
                                <span class="badge-role {{ $user->role === 'admin' ? 'badge-admin' : 'badge-user' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $user->updated_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="stats-card">
            <h5>Estadísticas del Sistema</h5>
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="stat-number">{{ $users->count() }}</div>
                    <div class="stat-label">Total de Usuarios</div>
                </div>
                <div class="col-md-4">
                    <div class="stat-number">{{ $users->where('role', 'admin')->count() }}</div>
                    <div class="stat-label">Administradores</div>
                </div>
                <div class="col-md-4">
                    <div class="stat-number">{{ $users->where('role', 'user')->count() }}</div>
                    <div class="stat-label">Usuarios</div>
                </div>
            </div>
        </div>

        <!-- Sección de Cartelera con Más Ventas -->
        @if($topEvent)
        <div class="stats-card mt-4">
            <h5>Cartelera con Más Ventas</h5>
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($topEvent->cover)
                        <img src="{{ asset('storage/' . $topEvent->cover) }}"
                             alt="{{ $topEvent->cover_description ?? $topEvent->name }}"
                             class="img-fluid rounded mb-3"
                             style="max-height: 250px; object-fit: cover; width: 100%;">
                    @else
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-center mb-3"
                             style="height: 250px;">
                            <i class="bi bi-image" style="font-size: 4rem; color: rgba(255,255,255,0.3);"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <h3 class="text-white mb-3">{{ $topEvent->name }}</h3>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-white mb-2">
                                <strong>Fecha:</strong>
                                {{ \Carbon\Carbon::parse($topEvent->date)->format('d/m/Y H:i') }}
                            </p>
                            <p class="text-white mb-2">
                                <strong>Precio por Ticket:</strong>
                                ${{ number_format($topEvent->ticket_price, 2) }}
                            </p>
                            @if($topEvent->rating)
                            <p class="text-white mb-2">
                                <strong>Clasificación:</strong>
                                {{ $topEvent->rating->name }}
                            </p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if($topEvent->categories->count() > 0)
                            <p class="text-white mb-2">
                                <strong>Categorías:</strong><br>
                                @foreach($topEvent->categories as $category)
                                    <span class="badge bg-secondary me-1">{{ $category->name }}</span>
                                @endforeach
                            </p>
                            @endif
                        </div>
                    </div>

                    <div class="row text-center mt-4">
                        <div class="col-md-4">
                            <div class="stat-number" style="font-size: 2rem;">{{ $topEvent->total_tickets_sold ?? 0 }}</div>
                            <div class="stat-label">Tickets Vendidos</div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-number" style="font-size: 2rem;">{{ $topEvent->total_reservations ?? 0 }}</div>
                            <div class="stat-label">Reservas</div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-number" style="font-size: 2rem;">${{ number_format($topEventRevenue, 2) }}</div>
                            <div class="stat-label">Ingresos Totales</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="stats-card mt-4">
            <h5>Cartelera con Más Ventas</h5>
            <p class="text-white-50 mb-0">No hay datos de ventas disponibles aún.</p>
        </div>
        @endif
    @endif

</x-layout>

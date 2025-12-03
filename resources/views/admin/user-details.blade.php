<x-layout>

    <x-slot:title>Detalles del Usuario - {{ $user->name }}</x-slot:title>

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

        .back-button {
            display: inline-block;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .back-button:hover {
            color: #ffffff;
            border-color: rgba(255, 0, 0, 0.5);
            background: rgba(255, 0, 0, 0.1);
            text-decoration: none;
        }

        .user-info-card {
            background: linear-gradient(135deg, rgba(30, 30, 30, 0.8), rgba(20, 20, 20, 0.8));
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .user-info-card h3 {
            color: #ffffff;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .info-row {
            display: flex;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: rgba(255, 255, 255, 0.6);
            font-weight: 600;
            min-width: 180px;
        }

        .info-value {
            color: rgba(255, 255, 255, 0.9);
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

        .badge-status {
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .badge-confirmed {
            background: rgba(0, 255, 0, 0.2);
            color: #44ff44;
        }

        .badge-cancelled {
            background: rgba(255, 0, 0, 0.2);
            color: #ff4444;
        }

        .reservations-section {
            background: rgba(20, 20, 20, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .reservations-section h3 {
            color: #ffffff;
            padding: 1.5rem;
            margin: 0;
            background: linear-gradient(135deg, rgba(255, 0, 0, 0.2), rgba(204, 0, 0, 0.2));
            font-weight: 600;
        }

        .reservations-table {
            margin-bottom: 0;
        }

        .reservations-table th {
            color: #ffffff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 1rem;
            border: none;
            background: rgba(255, 0, 0, 0.1);
        }

        .reservations-table td {
            color: rgba(255, 255, 255, 0.9);
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            vertical-align: middle;
        }

        .reservations-table tbody tr {
            transition: all 0.3s ease;
        }

        .reservations-table tbody tr:hover {
            background: rgba(255, 0, 0, 0.05);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(30, 30, 30, 0.8), rgba(20, 20, 20, 0.8));
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 0, 0, 0.3);
            box-shadow: 0 10px 30px rgba(255, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ff0000, #cc0000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .no-reservations {
            padding: 2rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
        }
    </style>

    <a href="{{ route('admin.users') }}" class="back-button">
        ← Volver al Panel de Usuarios
    </a>

    <div class="admin-header">
        <h1>Detalles del Usuario</h1>
        <p class="text-white mb-0">Información completa y reservas del usuario</p>
    </div>

    <div class="user-info-card">
        <h3>Información Personal</h3>
        <div class="info-row">
            <div class="info-label">ID:</div>
            <div class="info-value">{{ $user->id }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Nombre:</div>
            <div class="info-value"><strong>{{ $user->name }}</strong></div>
        </div>
        <div class="info-row">
            <div class="info-label">Email:</div>
            <div class="info-value">{{ $user->email }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Rol:</div>
            <div class="info-value">
                <span class="badge-role {{ $user->role === 'admin' ? 'badge-admin' : 'badge-user' }}">
                    {{ ucfirst($user->role) }}
                </span>
            </div>
        </div>
        <div class="info-row">
            <div class="info-label">Fecha de Registro:</div>
            <div class="info-value">{{ $user->created_at->format('d/m/Y H:i:s') }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Última Actualización:</div>
            <div class="info-value">{{ $user->updated_at->format('d/m/Y H:i:s') }}</div>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $reservations->count() }}</div>
            <div class="stat-label">Total de Reservas</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $reservations->where('status', 'confirmed')->count() }}</div>
            <div class="stat-label">Reservas Confirmadas</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $reservations->where('status', 'cancelled')->count() }}</div>
            <div class="stat-label">Reservas Canceladas</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">${{ number_format($reservations->where('status', 'confirmed')->sum('total_price'), 2) }}</div>
            <div class="stat-label">Total Gastado</div>
        </div>
    </div>

    <div class="reservations-section">
        <h3>Historial de Reservas</h3>

        @if($reservations->isEmpty())
            <div class="no-reservations">
                <p>Este usuario no tiene reservas registradas.</p>
            </div>
        @else
            <table class="table table-dark reservations-table">
                <thead>
                    <tr>
                        <th>ID Reserva</th>
                        <th>Evento</th>
                        <th>Cantidad</th>
                        <th>Precio Total</th>
                        <th>Estado</th>
                        <th>Fecha de Reserva</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td>#{{ $reservation->reservation_id }}</td>
                            <td>
                                <strong>{{ $reservation->event->title ?? 'N/A' }}</strong>
                                @if($reservation->event)
                                    <br>
                                    <small style="color: rgba(255, 255, 255, 0.6);">
                                        {{ \Carbon\Carbon::parse($reservation->event->release_date)->format('d/m/Y') }}
                                    </small>
                                @endif
                            </td>
                            <td>{{ $reservation->quantity }} entrada(s)</td>
                            <td>${{ number_format($reservation->total_price, 2) }}</td>
                            <td>
                                <span class="badge-status {{ $reservation->status === 'confirmed' ? 'badge-confirmed' : 'badge-cancelled' }}">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </td>
                            <td>{{ $reservation->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</x-layout>

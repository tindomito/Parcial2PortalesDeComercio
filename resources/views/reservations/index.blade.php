<?php
/** @var  \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Reservation[] $reservations */
?>
<x-layout>
    <x-slot:title>Mis Reservas</x-slot:title>

    <style>
        .reservations-header {
            background: linear-gradient(135deg, rgba(255, 0, 0, 0.1), rgba(204, 0, 0, 0.1));
            border: 1px solid rgba(255, 0, 0, 0.2);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .reservations-table {
            background: rgba(20, 20, 20, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        .reservations-table thead {
            background: linear-gradient(135deg, rgba(255, 0, 0, 0.2), rgba(204, 0, 0, 0.2));
        }

        .reservations-table th {
            color: #ffffff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 1rem;
            border: none;
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

        .badge-status {
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
        }

        .badge-confirmed {
            background: rgba(0, 255, 0, 0.2);
            color: #00ff00;
        }

        .badge-cancelled {
            background: rgba(255, 0, 0, 0.2);
            color: #ff4444;
        }

        .btn-cancel {
            background: rgba(255, 0, 0, 0.2);
            color: #ff4444;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: rgba(255, 0, 0, 0.3);
            color: #ff4444;
        }

        .no-results {
            text-align: center;
            padding: 3rem;
            color: rgba(255, 255, 255, 0.6);
            background: rgba(30, 30, 30, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }
    </style>

    <div class="reservations-header">
        <h1 class="mb-3">Mis Reservas</h1>
        <a href="{{ route('events.index') }}" class="btn-back">← Volver a Cartelera</a>
    </div>

    @if ($reservations->isNotEmpty())
        <div class="reservations-table">
            <table class="table table-dark mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Evento</th>
                        <th>Fecha del Evento</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Fecha de Reserva</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->reservation_id }}</td>
                            <td>
                                <strong>{{ $reservation->event->name }}</strong>
                            </td>
                            <td>{{ $reservation->event->date }}</td>
                            <td>{{ $reservation->quantity }}</td>
                            <td>${{ number_format($reservation->total_price, 0, ',', '.') }}</td>
                            <td>
                                @if($reservation->status === 'confirmed')
                                    <span class="badge-status badge-confirmed">Confirmada</span>
                                @else
                                    <span class="badge-status badge-cancelled">Cancelada</span>
                                @endif
                            </td>
                            <td>{{ $reservation->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($reservation->status === 'confirmed')
                                    <form action="{{ route('reservations.cancel', ['id' => $reservation->reservation_id]) }}" method="post" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-cancel" onclick="return confirm('¿Estás seguro de que deseas cancelar esta reserva?')">
                                            Cancelar
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $reservations->links() }}
        </div>
    @else
        <div class="no-results">
            <p class="mb-3">No tienes reservas aún</p>
            <a href="{{ route('events.index') }}" class="btn-back">Ver Cartelera</a>
        </div>
    @endif
</x-layout>

<x-layout>

    <x-slot:title>Mi Perfil</x-slot:title>

    <style>
        /* Estilos para fondo oscuro y letras clara */
        .profile-container {
            background-color: #1a1a1a;
            min-height: 100vh;
            padding: 2rem 0;
        }

        .profile-container h1 {
            color: #f0f0f0;
            font-weight: 600;
        }

        .profile-card {
            background-color: #2d2d2d;
            border: 1px solid #404040;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .profile-card .card-body {
            padding: 2rem;
        }

        .profile-row {
            padding: 1rem 0;
            border-bottom: 1px solid #404040;
        }

        .profile-row:last-of-type {
            border-bottom: none;
        }

        .profile-label {
            color: #a0a0a0;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .profile-value {
            color: #f0f0f0;
            font-size: 1.1rem;
        }

        .badge-dark {
            background-color: #4a90e2 !important;
            color: #ffffff;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .badge-secondary-dark {
            background-color: #5a5a5a !important;
            color: #f0f0f0;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .btn-primary-dark {
            background-color: #4a90e2;
            border: none;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary-dark:hover {
            background-color: #357abd;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(74, 144, 226, 0.3);
        }

        .btn-secondary-dark {
            background-color: #404040;
            border: 1px solid #5a5a5a;
            color: #f0f0f0;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-secondary-dark:hover {
            background-color: #4a4a4a;
            border-color: #6a6a6a;
            transform: translateY(-2px);
        }
    </style>

    <div class="profile-container">
        <div class="container">
            <h1 class="mb-4">Mi Perfil</h1>

            <div class="card profile-card">
                <div class="card-body">
                    <div class="row mb-3 profile-row">
                        <div class="col-md-3">
                            <span class="profile-label">Nombre:</span>
                        </div>
                        <div class="col-md-9">
                            <span class="profile-value">{{ $user->name }}</span>
                        </div>
                    </div>

                    <div class="row mb-3 profile-row">
                        <div class="col-md-3">
                            <span class="profile-label">Email:</span>
                        </div>
                        <div class="col-md-9">
                            <span class="profile-value">{{ $user->email }}</span>
                        </div>
                    </div>

                    <div class="row mb-3 profile-row">
                        <div class="col-md-3">
                            <span class="profile-label">Rol:</span>
                        </div>
                        <div class="col-md-9">
                            <span class="badge {{ $user->role === 'admin' ? 'badge-dark' : 'badge-secondary-dark' }}">
                                {{ $user->role === 'admin' ? 'Administrador' : 'Usuario' }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3 profile-row">
                        <div class="col-md-3">
                            <span class="profile-label">Miembro desde:</span>
                        </div>
                        <div class="col-md-9">
                            <span class="profile-value">{{ $user->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary-dark">
                            Editar Perfil
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-secondary-dark">
                            Volver al Inicio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>

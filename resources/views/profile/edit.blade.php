<x-layout>

    <x-slot:title>Editar Perfil</x-slot:title>

    <style>
        /* Estilos para fondo oscuro y letras claras */
        .profile-container {
            background-color: #1a1a1a;
            min-height: 100vh;
            padding: 2rem 0;
        }

        .profile-container h1,
        .profile-container h5 {
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

        .form-label {
            color: #a0a0a0;
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }

        .form-control {
            background-color: #1a1a1a;
            border: 1px solid #404040;
            color: #f0f0f0;
            padding: 0.75rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: #252525;
            border-color: #4a90e2;
            color: #f0f0f0;
            box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
        }

        .form-control::placeholder {
            color: #666;
        }

        .form-text {
            color: #888;
            font-size: 0.875rem;
        }

        .text-muted {
            color: #888 !important;
        }

        .alert-danger {
            background-color: #3d1f1f;
            border: 1px solid #5a2a2a;
            color: #ff6b6b;
        }

        .alert-danger ul {
            color: #ff6b6b;
        }

        .invalid-feedback {
            color: #ff6b6b;
        }

        .form-control.is-invalid {
            border-color: #ff6b6b;
        }

        hr {
            border-color: #404040;
            opacity: 1;
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
            <h1 class="mb-3">Editar Mi Perfil</h1>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card profile-card">
                <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}"
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}"
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4">

                <h5 class="mb-3">Cambiar Contraseña</h5>
                <p class="text-muted small">Deja estos campos en blanco si no deseas cambiar tu contraseña.</p>

                <div class="mb-3">
                    <label for="password" class="form-label">Nueva Contraseña</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">La contraseña debe tener al menos 8 caracteres.</div>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                    >
                </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary-dark">Guardar Cambios</button>
                            <a href="{{ route('profile.show') }}" class="btn btn-secondary-dark">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>

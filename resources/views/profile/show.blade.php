<x-layout>

    <x-slot:title>Mi Perfil</x-slot:title>

    <h1 class="mb-4">Mi Perfil</h1>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Nombre:</strong>
                </div>
                <div class="col-md-9">
                    {{ $user->name }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Email:</strong>
                </div>
                <div class="col-md-9">
                    {{ $user->email }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Rol:</strong>
                </div>
                <div class="col-md-9">
                    <span class="badge bg-{{ $user->role === 'admin' ? 'primary' : 'secondary' }}">
                        {{ $user->role === 'admin' ? 'Administrador' : 'Usuario' }}
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Miembro desde:</strong>
                </div>
                <div class="col-md-9">
                    {{ $user->created_at->format('d/m/Y') }}
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    Editar Perfil
                </a>
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    Volver al Inicio
                </a>
            </div>
        </div>
    </div>

</x-layout>

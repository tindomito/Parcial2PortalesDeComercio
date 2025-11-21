<x-layout>

    <x-slot:title>Panel de Administración - Usuarios</x-slot:title>

    <div class="row mb-4">
        <div class="col">
            <h1 class="mb-3">Panel de Administración - Usuarios</h1>
            <p class="text-muted">Total de usuarios registrados: <strong>{{ $users->count() }}</strong></p>
        </div>
    </div>

    @if($users->isEmpty())
        <div class="alert alert-info">
            No hay usuarios registrados en el sistema.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Email Verificado</th>
                        <th>Fecha de Registro</th>
                        <th>Última Actualización</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->email_verified_at)
                                    <span class="badge bg-success">
                                        {{ $user->email_verified_at->format('d/m/Y H:i') }}
                                    </span>
                                @else
                                    <span class="badge bg-warning">No verificado</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $user->updated_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <div class="card">
                <div class="card-header">
                    <h5>Estadísticas</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-center bg-primary text-white mb-3">
                                <div class="card-body">
                                    <h3>{{ $users->count() }}</h3>
                                    <p class="mb-0">Total de Usuarios</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center bg-success text-white mb-3">
                                <div class="card-body">
                                    <h3>{{ $users->whereNotNull('email_verified_at')->count() }}</h3>
                                    <p class="mb-0">Emails Verificados</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center bg-warning text-white mb-3">
                                <div class="card-body">
                                    <h3>{{ $users->whereNull('email_verified_at')->count() }}</h3>
                                    <p class="mb-0">Emails Sin Verificar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-layout>

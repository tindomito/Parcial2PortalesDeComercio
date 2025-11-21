<x-layout>

    <x-slot:title>Iniciar Sesion</x-slot:title>

    <h1 class="mb-3">Ingresar a tu cuenta</h1>

    <form action="{{ route('auth.authenticate') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>

        <p class="mt-3">
            ¿No tienes una cuenta? <a href="{{ route('auth.register') }}">Regístrate aquí</a>
        </p>
    </form>

</x-layout>

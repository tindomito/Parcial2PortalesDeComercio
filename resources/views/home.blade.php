<x-layout>
    <x-slot:title>Bienvenido - UFC Events</x-slot:title>

    <style>
        .hero-section {
            background: linear-gradient(135deg, rgba(20, 20, 20, 0.9) 0%, rgba(40, 40, 40, 0.9) 100%);
            border-radius: 16px;
            padding: 5rem 2rem;
            margin-bottom: 3rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ff0000, #cc0000);
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ffffff 0%, #cccccc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -2px;
            margin-bottom: 1.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 300;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #ff0000, #cc0000);
            color: #ffffff;
            padding: 1rem 2.5rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            border: none;
            display: inline-block;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(255, 0, 0, 0.4);
            color: #ffffff;
        }
        
        .btn-secondary-custom {
            background: transparent;
            color: #ffffff;
            padding: 1rem 2.5rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.3);
            display: inline-block;
        }
        
        .btn-secondary-custom:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
            color: #ffffff;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .feature-card {
            background: linear-gradient(135deg, rgba(30, 30, 30, 0.8) 0%, rgba(20, 20, 20, 0.8) 100%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 2.5rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: block;
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #ff0000, #cc0000);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }
        
        .feature-card:hover::before {
            transform: scaleX(1);
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            border-color: rgba(255, 0, 0, 0.3);
            box-shadow: 0 20px 40px rgba(255, 0, 0, 0.1);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, rgba(255, 0, 0, 0.2), rgba(204, 0, 0, 0.2));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 2rem;
        }
        
        .feature-card h3 {
            color: #ffffff;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        
        .feature-card p {
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.6;
            margin: 0;
        }
    </style>

    <div class="hero-section">
        <h1 class="hero-title">Bienvenido a UFC Events</h1>
        <p class="hero-subtitle">
            Tu plataforma definitiva para seguir todos los eventos de la UFC.<br>
            Descubre peleas, mantente informado y únete a la comunidad de fanáticos.
        </p>
        <div class="cta-buttons">
            @guest
                <a href="{{ route('auth.register') }}" class="btn-primary-custom">Crear Cuenta</a>
                <a href="{{ route('auth.login') }}" class="btn-secondary-custom">Iniciar Sesión</a>
            @else
                <a href="{{ route('events.index') }}" class="btn-primary-custom">Ver Cartelera</a>
                <a href="{{ route('news.index') }}" class="btn-secondary-custom">Leer Novedades</a>
            @endguest
        </div>
    </div>

    <div class="features-grid">
        <a href="{{ route('events.index') }}" class="feature-card">
            <div class="feature-icon">🥊</div>
            <h3>Cartelera de Eventos</h3>
            <p>Explora todos los eventos próximos y pasados de la UFC. Información detallada de cada pelea, peleadores y resultados.</p>
        </a>

        <a href="{{ route('news.index') }}" class="feature-card">
            <div class="feature-icon">📰</div>
            <h3>Últimas Novedades</h3>
            <p>Mantente al día con las últimas noticias, anuncios de peleas y actualizaciones del mundo de las MMA.</p>
        </a>

        <a href="{{ route('about') }}" class="feature-card">
            <div class="feature-icon">ℹ️</div>
            <h3>Sobre Nosotros</h3>
            <p>Conoce más sobre nuestra plataforma, nuestra misión y cómo puedes aprovechar al máximo tu experiencia.</p>
        </a>
    </div>

    @guest
        <div class="text-center" style="background: rgba(255, 0, 0, 0.05); border: 1px solid rgba(255, 0, 0, 0.2); border-radius: 12px; padding: 3rem;">
            <h2 class="text-white mb-3">¿Listo para comenzar?</h2>
            <p class="text-white-50 mb-4">Únete a nuestra comunidad y no te pierdas ningún evento de la UFC.</p>
            <a href="{{ route('auth.register') }}" class="btn-primary-custom">Registrarse Ahora</a>
        </div>
    @endguest
</x-layout>

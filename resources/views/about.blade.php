<x-layout>
    <x-slot:title>Quiénes Somos</x-slot:title>

    <style>
        .about-hero {
            background: linear-gradient(135deg, rgba(20, 20, 20, 0.9) 0%, rgba(40, 40, 40, 0.9) 100%);
            border-radius: 16px;
            padding: 4rem 2rem;
            margin-bottom: 3rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }
        
        .about-hero h1 {
            font-weight: 700;
            background: linear-gradient(135deg, #ffffff 0%, #cccccc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -2px;
        }
        
        .about-hero .lead {
            font-weight: 300;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.7);
        }
        
        .feature-card {
            background: linear-gradient(135deg, rgba(30, 30, 30, 0.8) 0%, rgba(20, 20, 20, 0.8) 100%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
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
        
        .feature-card h2 {
            color: #ffffff;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        
        .feature-card p {
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(255, 0, 0, 0.2), rgba(204, 0, 0, 0.2));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }
        
        .btn-feature {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-feature:hover {
            background: linear-gradient(135deg, #ff0000, #cc0000);
            border-color: transparent;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(255, 0, 0, 0.3);
        }
        
        .stats-section {
            background: rgba(255, 0, 0, 0.05);
            border: 1px solid rgba(255, 0, 0, 0.1);
            border-radius: 12px;
            padding: 2rem;
            margin-top: 3rem;
        }
        
        .stat-item {
            text-align: center;
            padding: 1rem;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ff0000, #cc0000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .stat-label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 0.5rem;
        }
    </style>

    <div class="about-hero text-center">
        <h1 class="display-2 mb-4">UFC</h1>
        <p class="lead mx-auto" style="max-width: 700px;">
            Tu destino definitivo para todo lo relacionado con la UFC.
            Explora eventos, descubre peleadores y mantente al día con las últimas noticias del octágono.
        </p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-lg-4">
            <div class="feature-card">
                <div class="feature-icon">
                    🥊
                </div>
                <h2>Cartelera</h2>
                <p>Accede a la información detallada de los próximos eventos y resultados pasados. Mantente informado sobre todas las peleas.</p>
                <a href="{{ route('events.index') }}" class="btn-feature">Ver Eventos</a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="feature-card">
                <div class="feature-icon">
                    📰
                </div>
                <h2>Novedades</h2>
                <p>Las últimas noticias, anuncios de peleas y actualizaciones del mundo de las MMA. No te pierdas ninguna novedad.</p>
                <a href="{{ route('news.index') }}" class="btn-feature">Leer Noticias</a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="feature-card">
                <div class="feature-icon">
                    👥
                </div>
                <h2>Comunidad</h2>
                <p>Únete a otros fanáticos, regístrate y sé parte de la experiencia UFC. Comparte tu pasión por las MMA.</p>
                @auth
                    <a href="{{ route('home') }}" class="btn-feature">Ir al Inicio</a>
                @else
                    <a href="{{ route('auth.register') }}" class="btn-feature">Registrarse</a>
                @endauth
            </div>
        </div>
    </div>

    <div class="stats-section">
        <div class="row">
            <div class="col-md-4 stat-item">
                <div class="stat-number">100+</div>
                <div class="stat-label">Eventos</div>
            </div>
            <div class="col-md-4 stat-item">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Disponibilidad</div>
            </div>
            <div class="col-md-4 stat-item">
                <div class="stat-number">∞</div>
                <div class="stat-label">Pasión por MMA</div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 pt-4" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">

    </div>
</x-layout>

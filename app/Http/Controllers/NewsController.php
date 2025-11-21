<?php

namespace App\Http\Controllers;

class NewsController extends Controller
{
    public function index()
    {
        // Array de novedades/noticias de ejemplo
        $news = [
            [
                'id' => 1,
                'title' => 'Nuevo Sistema de Películas Disponible',
                'date' => '2024-11-15',
                'summary' => 'Hemos lanzado un nuevo sistema para explorar y descubrir películas. Ahora puedes ver detalles completos, calificaciones y géneros.',
                'content' => 'Estamos emocionados de anunciar el lanzamiento de nuestro nuevo sistema de películas. Con esta actualización, los usuarios pueden navegar por un catálogo completo, ver información detallada de cada película incluyendo sinopsis, clasificación por edades, géneros y precios. El sistema también incluye búsqueda avanzada y filtros por género.',
            ],
            [
                'id' => 2,
                'title' => 'Registro de Usuarios Mejorado',
                'date' => '2024-11-10',
                'summary' => 'Implementamos mejoras en el proceso de registro para una experiencia más fluida y segura.',
                'content' => 'Hemos mejorado nuestro sistema de registro de usuarios con validaciones más robustas, mensajes de error más claros y un proceso de autenticación más seguro. Los usuarios ahora pueden crear cuentas de manera más rápida y sencilla.',
            ],
            [
                'id' => 3,
                'title' => 'Panel de Administración Actualizado',
                'date' => '2024-11-20',
                'summary' => 'Los administradores ahora tienen acceso a un panel mejorado para gestionar usuarios del sistema.',
                'content' => 'Presentamos el nuevo panel de administración que permite a los administradores ver todos los usuarios registrados, sus datos de contacto, fechas de registro y estadísticas generales del sistema. Esta herramienta facilita la gestión y monitoreo de la plataforma.',
            ],
            [
                'id' => 4,
                'title' => 'Control de Edad para Contenido',
                'date' => '2024-11-05',
                'summary' => 'Implementamos un sistema de verificación de edad para proteger a los menores de contenido inapropiado.',
                'content' => 'Como parte de nuestro compromiso con la seguridad, hemos implementado un sistema de verificación de edad que requiere que los usuarios confirmen su edad antes de acceder a películas con clasificaciones restringidas. Esto garantiza un entorno seguro para todos nuestros usuarios.',
            ],
        ];

        return view('news.index', [
            'news' => $news
        ]);
    }
}

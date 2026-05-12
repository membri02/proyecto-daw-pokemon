PROYECTO POKEMON TCG - DAW 2026

DESCRIPCION DEL PROYECTO
Este proyecto consiste en una plataforma web de coleccionismo de cartas digitales basada en el universo Pokemon. Desarrollado como proyecto final para el Grado Superior de Desarrollo de Aplicaciones Web (DAW) en el IES Virgen de la Paz, el sistema permite la gestion integral de una coleccion de cartas, economia virtual y minijuegos interactivos.

FUNCIONALIDADES PRINCIPALES
- Sistema de apertura de sobres con diferentes categorias de rareza.
- Gestion de album personal con visualizacion detallada de cartas.
- Algoritmo de deteccion de duplicados y conversion automatica a moneda virtual.
- Cuatro minijuegos para la obtencion de recompensas: Siluetas, Triler, Duelo de Tipos y Memoria.
- Panel de administracion para la gestion de usuarios y monitorizacion de datos.
- Sincronizacion automatica con la base de datos oficial PokeAPI para los 151 Pokemon originales.

STACK TECNOLOGICO
- Framework: Laravel 11 (PHP 8.2+)
- Base de Datos: MySQL / MariaDB
- Interfaz: Blade Templates y Vanilla CSS
- Logica de Cliente: JavaScript Nativo
- Gestion de Dependencias: Composer y NPM
- API Externa: PokeAPI

INSTRUCCIONES DE INSTALACION
1. Descargar o clonar el repositorio en el servidor local.
2. Ejecutar "composer install" para instalar las dependencias de backend.
3. Ejecutar "npm install" para instalar las dependencias de frontend.
4. Crear el archivo .env a partir del archivo .env.example.
5. Generar la clave de seguridad con "php artisan key:generate".
6. Configurar los parametros de conexion a la base de datos en el archivo .env.
7. Ejecutar "php artisan migrate --seed" para crear las tablas e importar los datos de las cartas.
8. Ejecutar "npm run dev" para la compilacion de activos.
9. Iniciar el servidor local con "php artisan serve".

EQUIPO DE DESARROLLO
- Andres: Lead Backend y Database
- Adrian: Frontend y UI/UX
- Miguel: Documentation Specialist

Desarrollado en Alcobendas, Madrid.

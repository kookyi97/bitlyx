-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2026 a las 03:46:19
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bitlyx_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intentos_quiz`
--

CREATE TABLE `intentos_quiz` (
  `id` int(11) UNSIGNED NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `correctas` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `xp_ganado` int(11) NOT NULL DEFAULT 0,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `intentos_quiz`
--

INSERT INTO `intentos_quiz` (`id`, `usuario_id`, `modulo_id`, `correctas`, `total`, `xp_ganado`, `fecha`) VALUES
(4, 2, 1, 1, 10, 10, '2026-06-12 00:15:38'),
(5, 2, 1, 4, 10, 40, '2026-06-12 00:18:52'),
(6, 2, 1, 7, 10, 70, '2026-06-12 03:52:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lecciones`
--

CREATE TABLE `lecciones` (
  `id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `contenido` text DEFAULT NULL,
  `orden` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lecciones`
--

INSERT INTO `lecciones` (`id`, `modulo_id`, `titulo`, `contenido`, `orden`) VALUES
(10, 1, 'Variables y tipos de datos', 'En PHP las variables inician con $. Tipos: String, Integer, Float, Boolean, Array, NULL. Ejemplo: $nombre = \"Bitlyx\"; $edad = 25; $activo = true;', 1),
(11, 1, 'Operadores en PHP', 'Operadores aritméticos: +, -, *, /, %. Operadores de comparación: ==, !=, >, <, >=, <=. Operadores lógicos: &&, ||, !. Concatenación con punto (.).', 2),
(12, 1, 'Condicionales if/else', 'if ($edad >= 18) { echo \"Mayor\"; } elseif ($edad >= 13) { echo \"Adolescente\"; } else { echo \"Menor\"; }. Permite tomar decisiones en el código.', 3),
(13, 1, 'Switch y match', 'Switch evalúa una variable contra múltiples casos. match es más moderno y retorna valores directamente. Siempre usar break en switch para evitar caídas.', 4),
(14, 1, 'Bucles for y while', 'for ($i=0; $i<5; $i++) itera un número fijo de veces. while ($condicion) itera mientras la condición sea verdadera. do-while ejecuta al menos una vez.', 5),
(15, 1, 'Arrays en PHP', 'Arrays indexados: $frutas = [\"manzana\",\"pera\"]. Arrays asociativos: $persona = [\"nombre\"=>\"Ana\",\"edad\"=>25]. Funciones: count(), array_push(), array_pop(), in_array().', 6),
(16, 1, 'Funciones', 'function suma($a, $b) { return $a + $b; }. Parámetros por defecto: function saludar($nombre = \"mundo\"). Funciones anónimas y arrow functions en PHP 7.4+.', 7),
(17, 1, 'Strings y funciones de texto', 'strlen() longitud, strtoupper() mayúsculas, strtolower() minúsculas, str_replace() reemplazar, substr() subcadena, strpos() posición, trim() quitar espacios.', 8),
(18, 1, 'Manejo de errores', 'try { codigo(); } catch (Exception $e) { echo $e->getMessage(); } finally { limpiar(); }. Tipos de errores: Notice, Warning, Fatal Error. Usar error_reporting().', 9),
(19, 1, 'PHP y formularios', 'Superglobales: $_GET para parámetros URL, $_POST para formularios, $_SESSION para sesiones, $_COOKIE para cookies. Siempre validar y sanitizar datos del usuario.', 10),
(20, 2, 'Introducción a bases de datos', 'Una base de datos relacional organiza datos en tablas. Cada tabla tiene filas (registros) y columnas (campos). El modelo relacional usa claves primarias y foráneas para relacionar tablas.', 1),
(21, 2, 'Creación de tablas', 'CREATE TABLE usuarios (id INT PRIMARY KEY AUTO_INCREMENT, nombre VARCHAR(100) NOT NULL, email VARCHAR(150) UNIQUE, edad INT, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);', 2),
(22, 2, 'INSERT — Insertar datos', 'INSERT INTO usuarios (nombre, email, edad) VALUES (\"Ana\", \"ana@email.com\", 25). Para múltiples registros: INSERT INTO tabla (col1, col2) VALUES (v1,v2),(v3,v4).', 3),
(23, 2, 'SELECT — Consultar datos', 'SELECT * FROM tabla. SELECT col1, col2 FROM tabla WHERE condicion. ORDER BY columna ASC/DESC. LIMIT 10. DISTINCT elimina duplicados. LIKE para búsquedas con comodines.', 4),
(24, 2, 'UPDATE y DELETE', 'UPDATE usuarios SET nombre=\"Juan\" WHERE id=1. DELETE FROM usuarios WHERE id=1. SIEMPRE usar WHERE en UPDATE y DELETE para no afectar todos los registros.', 5),
(25, 2, 'Funciones de agregación', 'COUNT(*) cuenta filas. SUM(col) suma valores. AVG(col) promedio. MAX(col) máximo. MIN(col) mínimo. Se usan con GROUP BY para agrupar resultados por categoría.', 6),
(26, 2, 'JOINs — Unir tablas', 'INNER JOIN: solo coincidencias. LEFT JOIN: todos de la izquierda + coincidencias. RIGHT JOIN: todos de la derecha. FULL JOIN: todos de ambas. ON define la condición de unión.', 7),
(27, 2, 'Índices y rendimiento', 'Los índices aceleran las consultas. PRIMARY KEY crea índice automáticamente. CREATE INDEX idx_email ON usuarios(email). EXPLAIN muestra cómo MySQL ejecuta una consulta.', 8),
(28, 2, 'Subconsultas', 'Una subconsulta es un SELECT dentro de otro. SELECT * FROM productos WHERE precio > (SELECT AVG(precio) FROM productos). Pueden usarse en WHERE, FROM y SELECT.', 9),
(29, 2, 'Transacciones', 'START TRANSACTION; INSERT...; UPDATE...; COMMIT; o ROLLBACK si hay error. Las transacciones garantizan que todas las operaciones se completen o ninguna (ACID).', 10),
(30, 3, 'Instalación y estructura', 'composer create-project laravel/laravel app. Estructura: app/ (lógica), routes/ (rutas), resources/views/ (vistas), database/ (migraciones), public/ (archivos públicos).', 1),
(31, 3, 'Rutas', 'Route::get(\"/ruta\", [Controller::class, \"metodo\"]). Métodos: get, post, put, patch, delete. Parámetros: {id}. Rutas con nombre: ->name(\"nombre\"). Grupos con prefix y middleware.', 2),
(32, 3, 'Controladores', 'php artisan make:controller ProductoController. Métodos: index(), create(), store(), show(), edit(), update(), destroy(). Resource controller: make:controller --resource.', 3),
(33, 3, 'Blade — Vistas', '{{ $var }} muestra escapado. {!! $html !!} muestra HTML. @if, @foreach, @forelse, @while. @extends(\"layout\") hereda plantilla. @section y @yield para secciones.', 4),
(34, 3, 'Eloquent ORM — Modelos', 'php artisan make:model Producto. Operaciones: Producto::all(), find($id), where(\"precio\",\">\",100)->get(), create([]), update([]), delete(). Relaciones: hasMany, belongsTo.', 5),
(35, 3, 'Migraciones', 'php artisan make:migration create_productos_table. Schema::create(), Schema::table(). Tipos: string, integer, boolean, timestamp, foreignId. php artisan migrate para ejecutar.', 6),
(36, 3, 'Validación de formularios', '$request->validate([\"nombre\"=>\"required|max:100\",\"email\"=>\"required|email|unique:usuarios\",\"precio\"=>\"required|numeric|min:0\"]). Los errores van a $errors en la vista.', 7),
(37, 3, 'Middleware', 'Los middleware filtran peticiones HTTP. auth verifica autenticación. Crear: php artisan make:middleware CheckRol. Registrar en Kernel.php. Usar en rutas: ->middleware(\"auth\").', 8),
(38, 3, 'Relaciones Eloquent', 'hasMany: un usuario tiene muchos pedidos. belongsTo: pedido pertenece a usuario. hasOne: uno a uno. belongsToMany: muchos a muchos con tabla pivot. Eager loading: with().', 9),
(39, 3, 'API REST con Laravel', 'Rutas en routes/api.php. Controladores retornan response()->json(). Códigos HTTP: 200 OK, 201 Created, 404 Not Found, 422 Unprocessable. API Resources para formatear respuestas.', 10),
(40, 4, 'Clases y objetos', 'class Persona { public $nombre; public function saludar() { return \"Hola, soy \".$this->nombre; } }. $p = new Persona(); $p->nombre = \"Ana\"; echo $p->saludar();', 1),
(41, 4, 'Propiedades y métodos', 'Visibilidad: public (accesible desde cualquier lugar), protected (clase y subclases), private (solo la clase). $this hace referencia al objeto actual. Métodos estáticos con static::.', 2),
(42, 4, 'Constructor y destructor', '__construct() se ejecuta al crear el objeto. __destruct() al destruirlo. Constructor con parámetros: function __construct($nombre, $edad) { $this->nombre = $nombre; }', 3),
(43, 4, 'Herencia', 'class Empleado extends Persona { public $empresa; }. La subclase hereda propiedades y métodos. parent::__construct() llama al constructor padre. override: redefinir método heredado.', 4),
(44, 4, 'Interfaces y clases abstractas', 'interface Pagable { public function pagar($monto); }. abstract class Animal { abstract public function sonido(); }. Las clases abstractas no se instancian directamente.', 5),
(45, 4, 'Encapsulamiento', 'Getters y setters controlan el acceso: public function getNombre() { return $this->nombre; } public function setNombre($n) { $this->nombre = $n; }. Protege la integridad de los datos.', 6),
(46, 4, 'Polimorfismo', 'Objetos de distintas clases pueden responder al mismo método de forma diferente. class Perro extends Animal { public function sonido() { return \"Guau\"; } }', 7),
(47, 4, 'Traits', 'Los traits permiten reutilizar código en múltiples clases. trait Loggable { public function log($msg) { echo $msg; } }. use Loggable; dentro de la clase.', 8),
(48, 4, 'Namespaces', 'namespace AppModels; evita conflictos de nombres. use AppModelsUsuario; para importar. Corresponde a la estructura de carpetas del proyecto.', 9),
(49, 4, 'Excepciones y manejo de errores OOP', 'throw new Exception(\"Error\"); try { } catch (Exception $e) { echo $e->getMessage(); }. Crear excepciones personalizadas: class MiExcepcion extends Exception { }.', 10),
(50, 5, 'Qué es una API REST', 'REST (Representational State Transfer) es un estilo de arquitectura. Usa HTTP: GET (leer), POST (crear), PUT/PATCH (actualizar), DELETE (eliminar). Respuestas en JSON.', 1),
(51, 5, 'Rutas de API en Laravel', 'Las rutas API van en routes/api.php. Prefijo /api automático. Route::apiResource() genera rutas REST. Sin CSRF por defecto. Stateless: sin sesiones.', 2),
(52, 5, 'Controladores API', 'php artisan make:controller Api/ProductoController --api. Retornar JSON: return response()->json($data, 200). Códigos de estado HTTP son importantes para comunicar el resultado.', 3),
(53, 5, 'Autenticación con Sanctum', 'php artisan install:api. Tokens: $user->createToken(\"token\")->plainTextToken. Middleware: auth:sanctum. Para SPAs y aplicaciones móviles.', 4),
(54, 5, 'API Resources', 'php artisan make:resource ProductoResource. Formatea la respuesta: public function toArray($request) { return [\"id\"=>$this->id, \"nombre\"=>$this->nombre]; }. ProductoResource::collection() para listas.', 5),
(55, 5, 'Validación en APIs', 'php artisan make:request StoreProductoRequest. rules() define las reglas. messages() personaliza mensajes. Laravel retorna 422 automáticamente si falla la validación.', 6),
(56, 5, 'Paginación', '$productos = Producto::paginate(15). La respuesta incluye data, current_page, total, per_page. Para APIs usar simplePaginate() o cursorPaginate() para mayor rendimiento.', 7),
(57, 5, 'Filtros y búsqueda', 'Usar query parameters: /api/productos?categoria=ropa&precio_max=100. En el controlador: $query->when($request->categoria, fn($q,$v) => $q->where(\"categoria\",$v)).', 8),
(58, 5, 'Manejo de errores API', 'Personalizar en app/Exceptions/Handler.php. Retornar JSON consistente: {\"error\":\"Mensaje\",\"code\":404}. Usar códigos HTTP correctos: 400, 401, 403, 404, 422, 500.', 9),
(59, 5, 'Testing de APIs', 'php artisan make:test ProductoTest. $response = $this->getJson(\"/api/productos\"). assertStatus(200). assertJsonStructure(). Usar Postman o Insomnia para pruebas manuales.', 10),
(60, 6, 'Fundamentos de seguridad web', 'Principales amenazas: XSS (Cross-Site Scripting), SQL Injection, CSRF, clickjacking. OWASP Top 10 lista las vulnerabilidades más críticas. Seguridad por capas (defensa en profundidad).', 1),
(61, 6, 'Autenticación en Laravel', 'php artisan make:auth (Breeze/Jetstream). Hash de contraseñas: Hash::make($password). Verificar: Hash::check($input, $hash). Nunca almacenar contraseñas en texto plano.', 2),
(62, 6, 'Middleware de autenticación', 'auth middleware verifica que el usuario esté logueado. guest redirige si ya está autenticado. Crear middleware personalizado: php artisan make:middleware VerificarRol.', 3),
(63, 6, 'Roles y permisos', 'Tabla roles, tabla permisos, tabla role_user. Verificar rol: $user->hasRole(\"admin\"). Paquetes como Spatie Laravel Permission simplifican la gestión de roles y permisos.', 4),
(64, 6, 'Protección CSRF', 'Laravel incluye protección CSRF automática. @csrf en formularios Blade agrega el token. Para APIs sin estado usar tokens (Sanctum) en vez de CSRF. El token se valida en cada POST.', 5),
(65, 6, 'Prevención de SQL Injection', 'Usar siempre Eloquent o Query Builder con parámetros vinculados. NUNCA concatenar input del usuario en SQL. DB::select(\"SELECT * FROM t WHERE id = ?\", [$id]) es seguro.', 6),
(66, 6, 'Prevención de XSS', '{{ $var }} en Blade escapa HTML automáticamente. Usar {!! !!} solo con contenido de confianza. Validar y sanitizar todo input. Content Security Policy (CSP) como capa adicional.', 7),
(67, 6, 'HTTPS y cifrado', 'HTTPS cifra la comunicación cliente-servidor. En Laravel: URL::forceScheme(\"https\"). Cifrado: encrypt($data), decrypt($data). Usar variables de entorno para claves secretas (.env).', 8),
(68, 6, 'Rate limiting', 'Limitar peticiones para prevenir ataques de fuerza bruta. En rutas: ->middleware(\"throttle:60,1\"). Personalizar en RouteServiceProvider. Responde con 429 Too Many Requests.', 9),
(69, 6, 'Auditoría y logs', 'Log::info(), Log::warning(), Log::error(). Archivo storage/logs/laravel.log. Registrar acciones sensibles: login, cambios de contraseña, acceso a datos confidenciales. Monitoreo activo.', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_05_31_200808_add_activo_to_usuarios_table', 2),
(6, '2026_06_09_161640_add_estado_to_modulos_table', 2),
(7, '2026_06_10_000001_create_intentos_quiz_table', 3),
(8, '2026_01_01_000002_create_resultados_quiz_table', 3),
(9, '2026_01_01_000003_create_preguntas_table', 3),
(10, '2026_01_01_000004_create_opciones_table', 3),
(11, '2026_06_10_000010_quiz_por_modulo', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` varchar(255) NOT NULL DEFAULT 'borrador'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `titulo`, `descripcion`, `created_at`, `estado`) VALUES
(1, 'Introducción a PHP', 'Conceptos básicos del lenguaje PHP', '2026-05-16 23:07:22', 'publicado'),
(2, 'Bases de Datos', 'Fundamentos de SQL', '2026-05-31 23:41:55', 'publicado'),
(3, 'Laravel', 'Framework PHP moderno', '2026-05-31 23:41:55', 'publicado'),
(4, 'Programación Orientada a Objetos (POO)', 'Clases, objetos, herencia y polimorfismo en PHP.', '2026-06-09 16:55:25', 'publicado'),
(5, 'API RESTful con Laravel', 'Creación de rutas, controladores de API y respuestas JSON.', '2026-06-09 16:55:25', 'publicado'),
(6, 'Autenticación y Seguridad', 'Implementación de Middleware, validación de roles y protección de rutas.', '2026-06-09 16:55:25', 'borrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE `opciones` (
  `id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `es_correcta` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`id`, `pregunta_id`, `texto`, `es_correcta`) VALUES
(373, 94, '$', 1),
(374, 94, '@', 0),
(375, 94, '#', 0),
(376, 94, '%', 0),
(377, 95, '.', 1),
(378, 95, '+', 0),
(379, 95, '&', 0),
(380, 95, '*', 0),
(381, 96, 'switch', 1),
(382, 96, 'if', 0),
(383, 96, 'for', 0),
(384, 96, 'while', 0),
(385, 97, 'strlen()', 1),
(386, 97, 'length()', 0),
(387, 97, 'size()', 0),
(388, 97, 'count()', 0),
(389, 98, 'function nombre($p) { }', 1),
(390, 98, 'def nombre($p) { }', 0),
(391, 98, 'func nombre($p) { }', 0),
(392, 98, 'method nombre($p) { }', 0),
(393, 99, 'Array asociativo', 1),
(394, 99, 'Array indexado', 0),
(395, 99, 'Array multidimensional', 0),
(396, 99, 'Array anidado', 0),
(397, 100, 'do-while', 1),
(398, 100, 'for', 0),
(399, 100, 'while', 0),
(400, 100, 'foreach', 0),
(401, 101, '$_POST', 1),
(402, 101, '$_GET', 0),
(403, 101, '$_REQUEST', 0),
(404, 101, '$_FORM', 0),
(405, 102, 'catch', 1),
(406, 102, 'error', 0),
(407, 102, 'except', 0),
(408, 102, 'handle', 0),
(409, 103, 'strtoupper()', 1),
(410, 103, 'toupper()', 0),
(411, 103, 'uppercase()', 0),
(412, 103, 'strUpper()', 0),
(413, 104, 'CREATE TABLE', 1),
(414, 104, 'MAKE TABLE', 0),
(415, 104, 'ADD TABLE', 0),
(416, 104, 'NEW TABLE', 0),
(417, 105, 'SELECT', 1),
(418, 105, 'GET', 0),
(419, 105, 'FETCH', 0),
(420, 105, 'FIND', 0),
(421, 106, 'WHERE', 1),
(422, 106, 'FILTER', 0),
(423, 106, 'HAVING', 0),
(424, 106, 'LIMIT', 0),
(425, 107, 'INNER JOIN', 1),
(426, 107, 'LEFT JOIN', 0),
(427, 107, 'RIGHT JOIN', 0),
(428, 107, 'FULL JOIN', 0),
(429, 108, 'AVG()', 1),
(430, 108, 'AVERAGE()', 0),
(431, 108, 'MEAN()', 0),
(432, 108, 'MID()', 0),
(433, 109, 'GROUP BY', 1),
(434, 109, 'ORDER BY', 1),
(435, 109, 'SORT BY', 0),
(436, 109, 'CLUSTER BY', 0),
(437, 110, 'UPDATE', 1),
(438, 110, 'MODIFY', 0),
(439, 110, 'CHANGE', 0),
(440, 110, 'ALTER', 0),
(441, 111, 'Deshace todos los cambios de la transacción', 1),
(442, 111, 'Guarda los cambios', 0),
(443, 111, 'Borra la tabla', 0),
(444, 111, 'Cierra la conexión', 0),
(445, 112, 'UNIQUE', 1),
(446, 112, 'NOT NULL', 0),
(447, 112, 'PRIMARY KEY', 0),
(448, 112, 'DISTINCT', 0),
(449, 113, 'Muestra cómo MySQL ejecuta una consulta', 1),
(450, 113, 'Elimina una consulta guardada', 0),
(451, 113, 'Comenta el código SQL', 0),
(452, 113, 'Optimiza automáticamente la consulta', 0),
(453, 114, 'routes/web.php', 1),
(454, 114, 'routes/api.php', 0),
(455, 114, 'app/routes.php', 0),
(456, 114, 'config/routes.php', 0),
(457, 115, 'php artisan make:controller', 1),
(458, 115, 'php artisan create:controller', 0),
(459, 115, 'php artisan new:controller', 0),
(460, 115, 'php artisan gen:controller', 0),
(461, 116, '{{ $var }}', 1),
(462, 116, '{! $var !}', 0),
(463, 116, '@show($var)', 0),
(464, 116, '<?= $var ?>', 0),
(465, 117, 'Model::all()', 1),
(466, 117, 'Model::get()', 0),
(467, 117, 'Model::find()', 0),
(468, 117, 'Model::list()', 0),
(469, 118, 'php artisan migrate', 1),
(470, 118, 'php artisan db:migrate', 0),
(471, 118, 'php artisan run:migrations', 0),
(472, 118, 'php artisan migration:run', 0),
(473, 119, '\"required\"', 1),
(474, 119, '\"obligatory\"', 0),
(475, 119, '\"mandatory\"', 0),
(476, 119, '\"notNull\"', 0),
(477, 120, 'auth', 1),
(478, 120, 'login', 0),
(479, 120, 'verified', 0),
(480, 120, 'session', 0),
(481, 121, 'hasMany', 1),
(482, 121, 'belongsTo', 0),
(483, 121, 'hasOne', 0),
(484, 121, 'belongsToMany', 0),
(485, 122, 'Genera las 7 rutas CRUD automáticamente', 1),
(486, 122, 'Crea solo la ruta GET', 0),
(487, 122, 'Protege las rutas con auth', 0),
(488, 122, 'Agrupa rutas con un prefijo', 0),
(489, 123, '@extends', 1),
(490, 123, '@include', 0),
(491, 123, '@layout', 0),
(492, 123, '@inherit', 0),
(493, 124, 'new', 1),
(494, 124, 'create', 0),
(495, 124, 'instance', 0),
(496, 124, 'make', 0),
(497, 125, 'private', 1),
(498, 125, 'protected', 0),
(499, 125, 'public', 0),
(500, 125, 'internal', 0),
(501, 126, '__construct()', 1),
(502, 126, '__init()', 0),
(503, 126, 'start()', 0),
(504, 126, 'onCreate()', 0),
(505, 127, 'extends', 1),
(506, 127, 'inherits', 0),
(507, 127, 'implements', 0),
(508, 127, 'uses', 0),
(509, 128, 'La clase abstracta puede tener métodos implementados, la interfaz no', 1),
(510, 128, 'Son exactamente iguales', 0),
(511, 128, 'La interfaz puede instanciarse, la abstracta no', 0),
(512, 128, 'La clase abstracta no puede tener propiedades', 0),
(513, 129, 'Referencia al objeto actual', 1),
(514, 129, 'Referencia a la clase padre', 0),
(515, 129, 'Referencia a una variable global', 0),
(516, 129, 'Referencia al constructor', 0),
(517, 130, 'Mecanismo para reutilizar código en múltiples clases', 1),
(518, 130, 'Un tipo especial de clase abstracta', 0),
(519, 130, 'Una forma de herencia múltiple completa', 0),
(520, 130, 'Una interfaz con implementación', 0),
(521, 131, 'Distintos objetos responden al mismo método de formas diferentes', 1),
(522, 131, 'Una clase hereda de múltiples clases', 0),
(523, 131, 'Un objeto puede cambiar de clase', 0),
(524, 131, 'Todos los métodos tienen el mismo nombre', 0),
(525, 132, 'Llama a un método o constructor de la clase padre', 1),
(526, 132, 'Crea un nuevo objeto padre', 0),
(527, 132, 'Elimina la herencia', 0),
(528, 132, 'Accede a métodos privados', 0),
(529, 133, 'Evitar conflictos de nombres entre clases', 1),
(530, 133, 'Mejorar el rendimiento', 0),
(531, 133, 'Ocultar el código fuente', 0),
(532, 133, 'Crear módulos independientes del proyecto', 0),
(533, 134, 'POST', 1),
(534, 134, 'GET', 0),
(535, 134, 'PUT', 0),
(536, 134, 'CREATE', 0),
(537, 135, '404', 1),
(538, 135, '500', 0),
(539, 135, '403', 0),
(540, 135, '400', 0),
(541, 136, 'routes/api.php', 1),
(542, 136, 'routes/web.php', 0),
(543, 136, 'app/Api/routes.php', 0),
(544, 136, 'config/api.php', 0),
(545, 137, '200', 1),
(546, 137, '201', 0),
(547, 137, '204', 0),
(548, 137, '301', 0),
(549, 138, 'Formatea y transforma los datos del modelo para la respuesta JSON', 1),
(550, 138, 'Crea automáticamente el modelo', 0),
(551, 138, 'Valida los datos de entrada', 0),
(552, 138, 'Gestiona la autenticación', 0),
(553, 139, '422', 1),
(554, 139, '400', 0),
(555, 139, '403', 0),
(556, 139, '500', 0),
(557, 140, 'Sanctum', 1),
(558, 140, 'Passport solo', 0),
(559, 140, 'JWT nativo', 0),
(560, 140, 'BasicAuth', 0),
(561, 141, 'JSON', 1),
(562, 141, 'XML', 0),
(563, 141, 'HTML', 0),
(564, 141, 'CSV', 0),
(565, 142, 'PATCH', 1),
(566, 142, 'PUT', 0),
(567, 142, 'POST', 0),
(568, 142, 'UPDATE', 0),
(569, 143, '429', 1),
(570, 143, '503', 0),
(571, 143, '408', 0),
(572, 143, '401', 0),
(573, 144, 'SQL Injection', 1),
(574, 144, 'XSS', 0),
(575, 144, 'CSRF', 0),
(576, 144, 'Clickjacking', 0),
(577, 145, '@csrf', 1),
(578, 145, '@token', 0),
(579, 145, '@protect', 0),
(580, 145, '@secure', 0),
(581, 146, 'Hash::make($password)', 1),
(582, 146, 'encrypt($password)', 0),
(583, 146, 'md5($password)', 0),
(584, 146, 'sha1($password)', 0),
(585, 147, 'Verifica que el usuario esté autenticado', 1),
(586, 147, 'Verifica el rol del usuario', 0),
(587, 147, 'Bloquea IPs sospechosas', 0),
(588, 147, 'Encripta la sesión', 0),
(589, 148, 'Cross-Site Scripting', 1),
(590, 148, 'Cross-Site Request Forgery', 0),
(591, 148, 'External Style Sheets', 0),
(592, 148, 'Cross-Server Exchange', 0),
(593, 149, 'Escapa el HTML para prevenir XSS', 1),
(594, 149, 'Muestra el HTML sin procesar', 0),
(595, 149, 'Valida el contenido automáticamente', 0),
(596, 149, 'Cifra la variable', 0),
(597, 150, '429', 1),
(598, 150, '503', 0),
(599, 150, '403', 0),
(600, 150, '408', 0),
(601, 151, 'En el archivo .env', 1),
(602, 151, 'En config/app.php directamente', 0),
(603, 151, 'En la base de datos', 0),
(604, 151, 'En public/keys.php', 0),
(605, 152, 'Hash::check($input, $hash)', 1),
(606, 152, 'Hash::verify($input, $hash)', 0),
(607, 152, 'Hash::compare($input, $hash)', 0),
(608, 152, 'Hash::match($input, $hash)', 0),
(609, 153, 'Aplicar múltiples capas de seguridad', 1),
(610, 153, 'Usar solo un método de seguridad muy fuerte', 0),
(611, 153, 'Defender solo la base de datos', 0),
(612, 153, 'Cifrar todo el código fuente', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `enunciado` text NOT NULL,
  `xp` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `modulo_id`, `enunciado`, `xp`) VALUES
(94, 1, '¿Con qué símbolo inician las variables en PHP?', 10),
(95, 1, '¿Cuál es el operador de concatenación en PHP?', 10),
(96, 1, '¿Qué estructura se usa para múltiples condiciones sobre la misma variable?', 10),
(97, 1, '¿Qué función devuelve la longitud de un string en PHP?', 10),
(98, 1, '¿Cómo se define una función en PHP?', 10),
(99, 1, '¿Qué tipo de array usa claves nombradas en PHP?', 15),
(100, 1, '¿Qué bucle garantiza ejecutarse al menos una vez?', 15),
(101, 1, '¿Qué superglobal contiene los datos enviados por un formulario POST?', 10),
(102, 1, '¿Qué bloque captura excepciones en PHP?', 10),
(103, 1, '¿Qué función convierte un string a mayúsculas en PHP?', 10),
(104, 2, '¿Qué comando crea una nueva tabla en SQL?', 10),
(105, 2, '¿Qué comando recupera datos de una tabla?', 10),
(106, 2, '¿Qué cláusula filtra los resultados en SQL?', 10),
(107, 2, '¿Qué JOIN devuelve solo los registros que coinciden en ambas tablas?', 15),
(108, 2, '¿Qué función SQL calcula el promedio de una columna?', 10),
(109, 2, '¿Qué cláusula agrupa resultados por una columna?', 15),
(110, 2, '¿Qué comando modifica datos existentes en una tabla?', 10),
(111, 2, '¿Qué garantiza una transacción con ROLLBACK?', 15),
(112, 2, '¿Qué constraint evita valores duplicados en una columna?', 10),
(113, 2, '¿Qué hace EXPLAIN en SQL?', 15),
(114, 3, '¿En qué archivo se definen las rutas web de Laravel?', 10),
(115, 3, '¿Qué comando Artisan crea un controlador?', 10),
(116, 3, '¿Qué directiva Blade muestra una variable de forma segura?', 10),
(117, 3, '¿Qué método Eloquent obtiene todos los registros de un modelo?', 10),
(118, 3, '¿Qué comando ejecuta las migraciones pendientes?', 15),
(119, 3, '¿Cómo se valida un campo requerido en Laravel?', 10),
(120, 3, '¿Qué middleware verifica que el usuario esté autenticado?', 10),
(121, 3, '¿Qué relación Eloquent representa \"un usuario tiene muchos pedidos\"?', 15),
(122, 3, '¿Qué hace Route::resource() en Laravel?', 15),
(123, 3, '¿Qué directiva Blade hereda una plantilla base?', 10),
(124, 4, '¿Qué palabra clave se usa para crear una nueva instancia de una clase?', 10),
(125, 4, '¿Qué visibilidad permite acceso solo desde la propia clase?', 10),
(126, 4, '¿Qué método se ejecuta automáticamente al crear un objeto?', 10),
(127, 4, '¿Qué palabra clave permite que una clase herede de otra?', 10),
(128, 4, '¿Qué diferencia hay entre una clase abstracta y una interfaz?', 15),
(129, 4, '¿Qué hace $this en una clase PHP?', 10),
(130, 4, '¿Qué son los traits en PHP?', 15),
(131, 4, '¿Qué es el polimorfismo?', 15),
(132, 4, '¿Qué hace parent:: en PHP?', 10),
(133, 4, '¿Para qué sirven los namespaces en PHP?', 10),
(134, 5, '¿Qué método HTTP se usa para crear un recurso?', 10),
(135, 5, '¿Qué código HTTP indica que un recurso no fue encontrado?', 10),
(136, 5, '¿En qué archivo se definen las rutas de la API en Laravel?', 10),
(137, 5, '¿Qué código HTTP indica una respuesta exitosa?', 10),
(138, 5, '¿Qué hace un API Resource en Laravel?', 15),
(139, 5, '¿Qué código HTTP se devuelve cuando la validación falla?', 15),
(140, 5, '¿Qué paquete de Laravel se usa para autenticación por tokens?', 10),
(141, 5, '¿Qué formato de datos usan principalmente las APIs REST?', 10),
(142, 5, '¿Qué método HTTP se usa para actualizar parcialmente un recurso?', 15),
(143, 5, '¿Qué código HTTP indica \"demasiadas peticiones\"?', 10),
(144, 6, '¿Qué ataque inserta código malicioso en campos de formulario para manipular SQL?', 15),
(145, 6, '¿Qué directiva Blade agrega automáticamente protección CSRF?', 10),
(146, 6, '¿Cómo se hashea una contraseña en Laravel?', 10),
(147, 6, '¿Qué hace el middleware \"auth\" en Laravel?', 10),
(148, 6, '¿Qué significa XSS?', 10),
(149, 6, '¿Qué hace {{ $var }} en Blade respecto a la seguridad?', 15),
(150, 6, '¿Qué código HTTP devuelve el rate limiting cuando se excede el límite?', 10),
(151, 6, '¿Dónde se deben almacenar las claves secretas en Laravel?', 15),
(152, 6, '¿Qué función verifica si una contraseña coincide con su hash en Laravel?', 10),
(153, 6, '¿Qué es la defensa en profundidad?', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progreso_usuario`
--

CREATE TABLE `progreso_usuario` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `leccion_id` int(11) NOT NULL,
  `completada` tinyint(1) DEFAULT 0,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `progreso_usuario`
--

INSERT INTO `progreso_usuario` (`id`, `usuario_id`, `leccion_id`, `completada`, `fecha`) VALUES
(42, 2, 10, 1, '2026-06-12 00:07:58'),
(43, 2, 11, 1, '2026-06-12 00:07:59'),
(44, 2, 12, 1, '2026-06-12 00:08:00'),
(45, 2, 13, 1, '2026-06-12 00:08:02'),
(46, 2, 14, 1, '2026-06-12 00:08:03'),
(47, 2, 15, 1, '2026-06-12 00:08:05'),
(48, 2, 16, 1, '2026-06-12 00:08:06'),
(49, 2, 17, 1, '2026-06-12 00:08:08'),
(50, 2, 18, 1, '2026-06-12 00:08:09'),
(51, 2, 19, 1, '2026-06-12 00:08:18'),
(52, 2, 20, 1, '2026-06-12 00:19:46'),
(53, 2, 21, 1, '2026-06-12 00:19:47'),
(54, 2, 22, 1, '2026-06-12 00:19:49'),
(55, 2, 23, 1, '2026-06-12 00:19:50'),
(56, 2, 24, 1, '2026-06-12 00:19:52'),
(57, 2, 25, 1, '2026-06-12 00:19:54'),
(58, 2, 26, 1, '2026-06-12 00:19:55'),
(59, 2, 27, 1, '2026-06-12 00:19:56'),
(60, 2, 28, 1, '2026-06-12 00:19:57'),
(61, 2, 29, 1, '2026-06-12 00:19:58'),
(62, 2, 30, 1, '2026-06-12 00:24:00'),
(63, 2, 31, 1, '2026-06-12 00:24:25'),
(64, 2, 32, 1, '2026-06-12 00:24:27'),
(65, 2, 33, 1, '2026-06-12 00:24:28'),
(66, 2, 34, 1, '2026-06-12 00:24:29'),
(67, 2, 35, 1, '2026-06-12 00:24:31'),
(68, 2, 36, 1, '2026-06-12 00:24:32'),
(69, 2, 37, 1, '2026-06-12 00:24:33'),
(70, 2, 38, 1, '2026-06-12 00:24:34'),
(71, 2, 39, 1, '2026-06-12 00:24:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados_quiz`
--

CREATE TABLE `resultados_quiz` (
  `id` int(11) UNSIGNED NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `correctas` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `xp_ganado` int(11) NOT NULL DEFAULT 0,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resultados_quiz`
--

INSERT INTO `resultados_quiz` (`id`, `usuario_id`, `modulo_id`, `correctas`, `total`, `xp_ganado`, `fecha`) VALUES
(3, 2, 1, 7, 10, 70, '2026-06-12 00:15:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'admin'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `xp_total` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol_id`, `xp_total`, `created_at`, `activo`) VALUES
(1, 'Admin Bitlyx', 'admin@bitlyx.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 0, '2026-05-16 23:07:22', 1),
(2, 'Juan Pérez', 'juan@bitlyx.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 125, '2026-05-16 23:07:22', 1),
(4, 'Yisel Aguilar', 'cruzyisel91@gmail.com', '$2y$10$JdAkxVYCG99ug8/.0g49LOPanaT8OfgIOSKqy1cYtEDYkm8sHs7l2', 2, 0, '2026-05-31 22:46:29', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `intentos_quiz`
--
ALTER TABLE `intentos_quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_usuario_leccion` (`usuario_id`);

--
-- Indices de la tabla `lecciones`
--
ALTER TABLE `lecciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modulo_id` (`modulo_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pregunta_id` (`pregunta_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `progreso_usuario`
--
ALTER TABLE `progreso_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `leccion_id` (`leccion_id`);

--
-- Indices de la tabla `resultados_quiz`
--
ALTER TABLE `resultados_quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_usuario_leccion` (`usuario_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `intentos_quiz`
--
ALTER TABLE `intentos_quiz`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `lecciones`
--
ALTER TABLE `lecciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `opciones`
--
ALTER TABLE `opciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=613;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT de la tabla `progreso_usuario`
--
ALTER TABLE `progreso_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `resultados_quiz`
--
ALTER TABLE `resultados_quiz`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lecciones`
--
ALTER TABLE `lecciones`
  ADD CONSTRAINT `lecciones_ibfk_1` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `progreso_usuario`
--
ALTER TABLE `progreso_usuario`
  ADD CONSTRAINT `progreso_usuario_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `progreso_usuario_ibfk_2` FOREIGN KEY (`leccion_id`) REFERENCES `lecciones` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# Proyecto: One Click Service

## Descripción
One Click Service es una plataforma web que permite contratar servicios como aseo, mantenimiento, jardinería y mensajería. Los usuarios pueden registrarse, contratar servicios, y calificar a los afiliados. 

Está diseñado para facilitar la conexión entre clientes y prestadores de servicios, de manera rápida y segura.

## Tecnologías utilizadas
- PHP
- HTML5
- CSS3
- MySQL
- Git (para control de versiones)

## Estructura del Proyecto
- `/views`: Formularios HTML de registro, login, contratación de servicios.
- `/controllers`: Scripts PHP que procesan datos enviados desde los formularios.
- `/models`: Archivos de conexión a base de datos y consultas SQL.
- `/css`: Archivos de estilo para la interfaz de usuario.
- `index.php`: Página de inicio del proyecto.

## Funcionalidades principales
- Registro de usuarios y afiliados.
- Inicio de sesión.
- Contratación de servicios.
- Administración básica de usuarios y servicios.
- Validaciones de datos en formularios.
- Conexión y consultas a base de datos MySQL.

## Métodos HTTP utilizados
- **POST**: Para enviar datos de los formularios (registro, login).
- **GET**: Para obtener datos y visualizar páginas o registros.

## Instrucciones para ejecución
1. Clonar el repositorio de GitHub o descargar el proyecto.
2. Configurar la base de datos importando el archivo `db.sql` en phpMyAdmin.
3. Ajustar las credenciales de conexión en el archivo `conexion.php`.
4. Ejecutar el proyecto en un servidor local como XAMPP, WAMP o Laragon.
5. Acceder a `http://localhost/nombre-del-proyecto/index.php`.

## Evidencias
- Formularios HTML funcionando.
- Procesamiento de formularios mediante PHP.
- Métodos POST y GET implementados correctamente.
- Base de datos funcionando y conectada.
- Versionamiento del proyecto en Git.

## Autor
- **Tatiana Marrugo Jiménez**
- **SENA - 2025**

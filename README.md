# Biblioteca

## Documentación

#### Distribución de archvios
Para los imports de los archivos se configuro un autoloader (autoloader.php) que busca el archivo de la clase \Nombredeespacio\Clase en /nombredeespacio/Clase.php

#### Arquitectura
El proyecto cumple con el patrón MVC sin el uso de liberías o frameworks, todo desarrollado por mí. Se desarrolló una clase Utils\Router
que se encarga de decodificar los request (mediante url y metodo) y ejecutar el metodo del controlador correspondiente. 
- El modelo se encarga de los accesos a la base mediante los repositorios que realizan las consultas SQL
- El controlador se encarga de generar la vista y cargar los datos a partir de los obtenidos por el modelo
- Cada vista tiene una clase que extiende de View\BasicView donde se define el template (dentro de /templates) que se va a renderizar 
y a su vez la clase Basicview antes renderiza el template common.php que contiene la visual común a todo el sitio.
- El Router se configura en el index.php debiendo indicar: la url relativa, opcionalmente con parámetros; el controlador que se va a instanciar;
el método que se a ejecutar, pudiendo diferenciar entre POST y GET; y opcionalmente una lista de interceptores definidos en \Interceptor que sirven para detectar
si el usuario actual está logueado, o si es lector, o si es bibliotecario de manera de segurizar las urls.

## Instalación

- Configurar la base la clase Utils\DBConnection
- Configurar el apache para habilitar Override de urls
- Correr el archivo schema.sql para generar las tablas de la base de datos
- Correr el archivo data.sql para generar datos de prueba

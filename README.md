# 🚀 NexStock - Sistema de Gestión de Inventario Inteligente

![Estado del Proyecto](https://img.shields.io/badge/Estado-En_Desarrollo-yellow)
![PHP](https://img.shields.io/badge/Backend-PHP_8.2-blue)
![MySQL](https://img.shields.io/badge/Database-MySQL_8.0-orange)
![Docker](https://img.shields.io/badge/Infraestructura-Docker-2496ED)

## 📖 Descripción
NexStock es una solución SaaS (Software as a Service) diseñada para la gestión eficiente de inventarios en Pymes. Permite a múltiples negocios gestionar sus productos, controlar el stock en tiempo real y visualizar métricas clave, todo bajo una arquitectura segura y segregada.

El proyecto está construido con tecnologías estándar de la industria, priorizando la escalabilidad, la seguridad y la facilidad de despliegue.

## ✨ Características Principales (Planeadas)
* 🔐 **Autenticación Segura:** Sistema de Login y Registro con encriptación.
* 🏢 **Multi-Tenencia:** Soporte para múltiples negocios en una sola instalación.
* 📦 **CRUD Completo:** Gestión total de productos (Crear, Leer, Editar, Eliminar).
* 📊 **Dashboard:** Visualización gráfica de métricas de negocio.
* 🛡️ **Seguridad:** Protección contra inyecciones SQL (PDO) y XSS.

## 🛠️ Stack Tecnológico
* **Lenguaje:** PHP 8.2 (Nativo)
* **Base de Datos:** MySQL 8.0
* **Servidor Web:** Apache
* **Frontend:** HTML5, CSS3 (Diseño personalizado), JS Vanilla
* **Contenedorización:** Docker & Docker Compose

## 🚀 Instalación y Despliegue (Local)

1.  **Clonar el repositorio:**
    ```bash
    git clone [https://github.com/TU_USUARIO/NexStock.git](https://github.com/TU_USUARIO/NexStock.git)
    cd NexStock
    ```

2.  **Configurar variables de entorno:**
    Crea un archivo `.env` basado en el ejemplo y configura tus credenciales de base de datos.

3.  **Levantar con Docker:**
    ```bash
    docker-compose up --build
    ```

4.  **Acceder:**
    Abre tu navegador en `http://localhost:80`

## 👥 Autores
* **Luciano Aliaga** - *Lead Developer*

---
© 2025 NexStock. Todos los derechos reservados.
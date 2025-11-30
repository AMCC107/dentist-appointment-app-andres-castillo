# Sistema de Gestión de Citas Dentales

## Información General

**Nombre del Proyecto:** Sistema de Gestión de Citas Dentales

**Descripción:** Sistema web para la gestión integral de citas de un consultorio dental. Permite administrar citas, tratamientos y pacientes con un sistema de roles que incluye acceso exclusivo para administradores. El administrador tiene acceso a un dashboard completo donde puede visualizar y gestionar todos los datos del sistema, incluyendo tratamientos, citas y pacientes.

---

## Funcionalidades Principales

- **Gestión de Citas:** Crear, editar, visualizar y eliminar citas médicas
- **Gestión de Tratamientos:** Administración completa de tratamientos dentales disponibles
- **Gestión de Pacientes:** Registro y administración de información de pacientes
- **Dashboard Administrativo:** Panel de control exclusivo para administradores con visualización de datos clave
- **Sistema de Roles:** Control de acceso basado en roles (Administrador, Doctor, Recepcionista, Paciente)
- **Protección de Rutas:** Middleware que restringe el acceso según el rol del usuario
- **CRUD Restringido:** Operaciones de creación, lectura, actualización y eliminación controladas por permisos
- **Desactivación de Usuarios:** Funcionalidad para desactivar usuarios sin eliminarlos del sistema (soft deletes)

---

## 🛠️ Tecnologías Utilizadas

### Backend
- **PHP 8.3+** - Lenguaje de programación
- **Laravel 12.0** - Framework PHP
- **Laravel Jetstream 5.3** - Autenticación y gestión de equipos
- **Laravel Fortify** - Autenticación backend
- **Laravel Sanctum 4.0** - Autenticación API
- **Spatie Laravel Permission 6.21** - Gestión de roles y permisos
- **Composer** - Gestor de dependencias PHP

### Frontend
- **Livewire 3.6.4** - Framework full-stack (stack `livewire`)
- **WireUI 2.4** - Componentes UI para Livewire
- **Tailwind CSS 3.4.0** - Framework CSS utility-first
- **Vite 7.0.4** - Build tool y bundler
- **Rappasoft Livewire Tables 3.7** - Tablas interactivas con Livewire
- **Flowbite 3.1.2** - Componentes UI basados en Tailwind

### Testing
- **Pest PHP 4.0** - Framework de testing

---

## Instrucciones para Ejecutar Localmente

### Requisitos Previos

- PHP 8.3 o superior
- Composer
- Node.js y npm
- Base de datos (MySQL, PostgreSQL o SQLite)
- Servidor web (Apache/Nginx) o PHP built-in server

### Pasos de Instalación

1. **Clonar el repositorio:**

```bash
git clone [URL_DEL_REPOSITORIO]
cd dentist-appointment-app
```

2. **Instalar dependencias de PHP:**

```bash
composer install
```

3. **Configurar archivo `.env`:**

```bash
cp .env.example .env
```

Editar el archivo `.env` y configurar las credenciales de la base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```

4. **Generar clave de aplicación:**

```bash
php artisan key:generate
```

5. **Ejecutar migraciones y seeders:**

```bash
php artisan migrate --seed
```

Este comando creará las tablas necesarias y poblará la base de datos con datos de prueba, incluyendo usuarios con diferentes roles.

6. **Instalar dependencias de Node.js:**

```bash
npm install
```

o

```bash
npm ci
```

7. **Compilar assets (desarrollo):**

```bash
npm run dev
```

Para producción:

```bash
npm run build
```

8. **Iniciar el servidor de desarrollo:**

```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`

### Usuario Administrador de Prueba

Después de ejecutar las migraciones y seeders, puedes iniciar sesión con las siguientes credenciales:

- **Email:** `andres17cc95@gmail.com`
- **Contraseña:** `12345678`

Este usuario tiene el rol de **Administrador** y tiene acceso completo al sistema.

---

## 📁 Estructura del Proyecto

```
dentist-appointment-app/
├── app/
│   ├── Actions/          # Acciones de Jetstream y Fortify
│   ├── Http/
│   │   ├── Controllers/  # Controladores de la aplicación
│   │   └── Middleware/   # Middleware personalizado
│   ├── Livewire/
│   │   └── Admin/        # Componentes Livewire para administración
│   ├── Models/           # Modelos Eloquent (Appointment, Patients, Treatment, User, Role)
│   └── Providers/        # Service providers
├── database/
│   ├── factories/        # Factories para testing
│   ├── migrations/       # Migraciones de base de datos
│   └── seeders/          # Seeders para datos iniciales
├── resources/
│   ├── css/              # Estilos CSS
│   ├── js/               # JavaScript
│   └── views/            # Vistas Blade
│       ├── admin/        # Vistas del panel administrativo
│       ├── appointments/ # Vistas de citas
│       ├── patients/     # Vistas de pacientes
│       └── treatments/   # Vistas de tratamientos
├── routes/
│   ├── admin.php         # Rutas administrativas
│   ├── api.php           # Rutas API
│   └── web.php           # Rutas web
├── tests/                # Tests automatizados
└── public/               # Archivos públicos
```

### Modelos Principales

- **User:** Usuarios del sistema con roles y permisos
- **Patients:** Información de pacientes
- **Treatment:** Tratamientos dentales disponibles
- **Appointment:** Citas médicas programadas
- **Role:** Roles del sistema (Administrador, Doctor, Recepcionista, Paciente)

---

## 💻 Uso del Sistema

### Acceso al Dashboard

1. Inicia sesión con las credenciales de administrador
2. Una vez autenticado, serás redirigido al dashboard administrativo
3. El dashboard muestra información general y estadísticas del sistema

### Módulos Principales

#### Gestión de Citas
- Accede desde el menú de navegación
- Visualiza todas las citas en una tabla interactiva
- Crea nuevas citas asociando pacientes y tratamientos
- Edita o elimina citas existentes
- Filtra y busca citas por diferentes criterios

#### Gestión de Tratamientos
- Administra el catálogo de tratamientos disponibles
- Crea nuevos tratamientos con descripción y precio
- Edita información de tratamientos existentes
- Desactiva tratamientos (soft delete) sin eliminarlos permanentemente

#### Gestión de Pacientes
- Registra nuevos pacientes con su información completa
- Visualiza el historial de pacientes
- Edita información de pacientes
- Gestiona el estado de los pacientes (activo/inactivo)

#### Gestión de Usuarios (Solo Administrador)
- Visualiza todos los usuarios del sistema
- Crea nuevos usuarios asignando roles
- Edita información de usuarios
- Desactiva usuarios sin eliminarlos del sistema

### Control de Acceso

- Las rutas están protegidas por middleware que verifica roles y permisos
- Solo usuarios con el rol de **Administrador** pueden acceder al dashboard y módulos administrativos
- Cada módulo valida los permisos antes de permitir operaciones CRUD
---

## 🧪 Testing

Para ejecutar los tests del proyecto:

```bash
php artisan test
```

---

## 📝 Licencia

Este proyecto es de código abierto y está disponible bajo la [Licencia MIT](LICENSE).

---

## 👥 Contribuciones

Las contribuciones son bienvenidas. Por favor, abre un issue o pull request para cualquier mejora o corrección.

---

## 📧 Contacto

Para más información o soporte, contacta al equipo de desarrollo.

---

**Versión:** 1.0.0  
**Última actualización:** 2025

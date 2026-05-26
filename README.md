Markdown
## 🚀 Instalación y Despliegue Local

Sigue estos pasos para levantar el entorno de desarrollo en tu máquina:



**1. Clona el repositorio:**

```bash
git clone [https://github.com/eduorozco01/underwave.git](https://github.com/eduorozco01/underwave.git)
cd underwave
2. Instala las dependencias del backend (PHP/Laravel):

Bash
composer install
3. Instala las dependencias del frontend (React/Tailwind):

Bash
npm install
4. Configura el entorno:

Copia el archivo de ejemplo y configura tus credenciales de base de datos MySQL.

Bash
cp .env.example .env
php artisan key:generate
5. Ejecuta las migraciones:

Bash
php artisan migrate
6. Levanta los servidores de desarrollo:

En una terminal para el backend:

Bash
php artisan serve
En otra terminal para compilar el frontend (Vite/Mix):

Bash
npm run dev

###

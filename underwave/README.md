# 🌊 UNDERWAVE

> *La marea de la música independiente y la cultura underground.*

---

## 🎸 Sobre el Proyecto

**Underwave** es una plataforma diseñada para conectar de forma directa a la comunidad musical indie y underground. Nuestra misión es descentralizar la organización de eventos, dar visibilidad a las bandas emergentes y apoyar a las salas que mantienen viva la cultura alternativa.

### ✨ Características Principales

* **Perfiles de Artistas y Salas:** Espacios dedicados para que bandas y locales conecten.
* **Cartelera Descentralizada:** Gestión y descubrimiento de bolos y eventos underground.
* **Interfaz Retro-Moderna:** Navegación rápida con un diseño rompedor.

---

## 🛠️ Stack Tecnológico

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![React](https://img.shields.io/badge/react-%2320232a.svg?style=for-the-badge&logo=react&logoColor=%2361DAFB)
![TailwindCSS](https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)

---

## 🚀 Instalación y Despliegue Local

Sigue estos pasos para levantar el entorno de desarrollo en tu máquina:

**1. Clona el repositorio:**
```bash
git clone https://github.com/eduorozco01/underwave.git
cd underwave
```

**2. Instala las dependencias del backend:**
```bash
composer install
```

**3. Instala las dependencias del frontend:**
```bash
npm install
```

**4. Configura el entorno:**
```bash
cp .env.example .env
php artisan key:generate
```

**5. Ejecuta las migraciones:**
```bash
php artisan migrate
```

**6. Levanta los servidores:**

En una terminal para el backend:
```bash
php artisan serve
```

En otra terminal para el frontend:
```bash
npm run dev
```

---

## 🤝 Contribución

Actualmente el proyecto está en fase de desarrollo principal. Si quieres contribuir, abre un Issue o envía un Pull Request en la rama `desarrollo`.

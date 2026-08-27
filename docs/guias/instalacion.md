# 📦 Guía de Instalación - Virtud y Victoria Nº 277

> **Propósito de este documento**: Instrucciones paso a paso para instalar el tema Virtud y Victoria en un servidor WordPress (local o producción). Incluye verificación post-instalación.

## Requisitos Previos

| Componente | Versión Mínima | Recomendada |
|------------|----------------|-------------|
| PHP | 8.0 | 8.1+ |
| MySQL | 5.7 | 8.x |
| WordPress | 6.0 | 6.x |
| Apache/Nginx | - | Última versión |

### Extensiones PHP Requeridas

```
php-mysql
php-curl
php-gd
php-mbstring
php-xml
php-zip
php-intl
```

---

## Instalación del Tema

### Opción 1: Subir vía Admin de WordPress

1. **Comprimir el tema**:
   ```bash
   cd wp-theme/
   zip -r virtud-y-victoria.zip virtud-y-victoria/
   ```

2. **Subir al admin**:
   - Ir a **Apariencia → Temas → Agregar Nuevo → Subir Tema**
   - Seleccionar `virtud-y-victoria.zip`
   - Hacer clic en **Instalar**

3. **Activar**:
   - Hacer clic en **Activar**

### Opción 2: Subir vía FTP/SFTP

1. **Conectar al servidor** con cliente FTP (FileZilla, Cyberduck)

2. **Copiar carpeta**:
   ```
   /wp-content/themes/virtud-y-victoria/
   ```

3. **Activar** en wp-admin → **Apariencia → Temas**

### Opción 3: WP-CLI

```bash
wp theme install wp-theme/virtud-y-victoria/ --activate
```

---

## Configuración Post-Instalación

### 1. Permalinks

Ir a **Ajustes → Enlaces permanentes** y seleccionar:
- **Nombre de la entrada**: `https://tusitio.com/nombre-de-entrada/`

Hacer clic en **Guardar cambios**.

### 2. Información del Sitio

Ir a **Ajustes → Generales**:
- **Título del sitio**: Virtud y Victoria Nº 277
- **Descripción**: Respetable Logia Simbólica
- **Zona horaria**: Caracas
- **Formato de fecha**: 26 de agosto de 2026

### 3. Menús de Navegación

Ir a **Apariencia → Menús**:

**Menú Principal** (ubicación: Principal):
```
Inicio
├── La Masonería
├── Quiénes Somos
├── Eventos
├── Galería
├── Blog
└── Contacto
```

**Menú Footer** (ubicación: Footer):
```
Inicio
├── Quiénes Somos
├── La Masonería
├── Eventos
├── Contacto
└── Política de Privacidad
```

### 4. Customizer

Ir a **Apariencia → Personalizar**:

**Información de la Logia**:
- Teléfono: +58 (XXX) XXX-XXXX
- Email: info@virtudyvictoria277.com
- Dirección: [Dirección del templo]
- URL Facebook: [URL]
- URL Instagram: [URL]

**Hero Slider** (3 slides):
- Slide 1: Título, subtítulo, texto, CTA
- Slide 2: Título, subtítulo, texto, CTA
- Slide 3: Título, subtítulo, texto, CTA

**Configuración de Inicio**:
- Número de posts: 3
- Número de masones: 6
- Número de eventos: 4
- Número de galería: 8

**Llamada a la Acción**:
- Título: ¿Quieres Ser Masón?
- Texto: [Descripción]
- Botón: Contáctanos

### 5. Páginas

Crear las siguientes páginas y asignarles los templates:

| Página | Template | slug |
|--------|----------|------|
| Inicio | Página Principal (front-page) | - |
| Quiénes Somos | Quiénes Somos | quienes-somos |
| La Masonería | La Masonería | la-masoneria |
| Eventos | Archivo de Eventos | eventos |
| Galería | Galería | galeria |
| Blog | Archivo de Entradas | blog |
| Contacto | Página | contacto |
| Política de Privacidad | Política de Privacidad | politica-de-privacidad |

### 6. Página de Inicio

Ir a **Ajustes → Lectura**:
- **La portada muestra**: Una página estática
- **La portada**: Inicio
- **Las entradas del blog muestran**: Blog

---

## Plugins Recomendados

| Plugin | Función | Prioridad |
|--------|---------|-----------|
| **Contact Form 7** | Formulario de contacto | 🔴 Alta |
| **Yoast SEO** | Optimización SEO | 🔴 Alta |
| **Wordfence Security** | Seguridad | 🔴 Alta |
| **WP Super Cache** | Caché | 🔴 Alta |
| **UpdraftPlus** | Backups | 🔴 Alta |
| **The Events Calendar** | Eventos (ya instalado) | 🟡 Media |
| **Simple Lightbox** | Galería | 🟡 Media |

---

## Verificación Post-Instalación

- [ ] El tema se muestra correctamente
- [ ] El logo aparece en el header
- [ ] El menú principal funciona
- [ ] El hero slider rota automáticamente
- [ ] Los links del footer funcionan
- [ ] La página de Quiénes Somos carga
- [ ] La página de La Masonería carga
- [ ] Los eventos se muestran
- [ ] La galería se muestra
- [ ] El formulario de contacto funciona
- [ ] El sitio es responsive (probar en móvil)
- [ ] Los breadcrumbs funcionan

---

*Guía actualizada: 26 de agosto de 2026*

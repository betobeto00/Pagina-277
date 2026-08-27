# ⚙️ Guía de Configuración - Virtud y Victoria Nº 277

> **Propósito de este documento**: Configuración avanzada de WordPress, plugins, customizer, custom post types, seguridad, email SMTP, redes sociales y analytics. Consultar al configurar una funcionalidad nueva.

## Configuración del Tema

### Customizer (Apariencia → Personalizar)

#### Información de la Logia
```
Sección: Información de la Logia
├── Teléfono: +58 (XXX) XXX-XXXX
├── Email: info@virtudyvictoria277.com
├── Dirección: [Dirección del templo]
├── URL Facebook: https://facebook.com/...
└── URL Instagram: https://instagram.com/...
```

#### Hero Slider
```
Sección: Hero Slider
├── Slide 1
│   ├── Título: "Virtud y Victoria Nº 277"
│   ├── Subtítulo: "Respetable Logia Simbólica"
│   ├── Texto: [Descripción de la logia]
│   ├── Texto CTA: "Contáctanos"
│   ├── URL CTA: /contacto
│   └── Imagen: [Subir imagen 1920x1080]
├── Slide 2
│   ├── Título: "La Masonería"
│   ├── Subtítulo: "Ciencia Moral y Filosófica"
│   ├── Texto: [Descripción]
│   ├── Texto CTA: "Conoce Más"
│   ├── URL CTA: /la-masoneria
│   └── Imagen: [Subir imagen]
└── Slide 3
    ├── Título: "Eventos y Tenidas"
    ├── Subtítulo: "Calendario de Actividades"
    ├── Texto: [Descripción]
    ├── Texto CTA: "Ver Eventos"
    ├── URL CTA: /eventos
    └── Imagen: [Subir imagen]
```

#### Configuración de Inicio
```
Sección: Configuración de Inicio
├── Número de posts en Inicio: 3
├── Número de masones célebres: 6
├── Número de eventos: 4
└── Número de imágenes galería: 8
```

#### Llamada a la Acción (CTA)
```
Sección: Llamada a la Acción
├── Título CTA: "¿Quieres Ser Masón?"
├── Texto CTA: "La Masonería es una institución..."
├── Texto del Botón: "Contáctanos"
└── URL del Botón: /contacto
```

---

## Configuración de Plugins

### Yoast SEO

**General → Tablero**:
- Completar el tour de configuración

**Títulos y Metas**:
```
Página Inicio:
- Título: Virtud y Victoria Nº 277 | Logia Masónica Venezolana
- Descripción: Respetable Logia Simbólica Virtud y Victoria Nº 277...

Entradas:
- Título: %%title%% | Virtud y Victoria Nº 277
- Descripción: %%excerpt%%

Eventos:
- Título: %%title%% | Eventos | Virtud y Victoria Nº 277
```

**Social**:
- Facebook: [URL de Facebook]
- Instagram: [URL de Instagram]

### Contact Form 7

**Crear formulario de contacto**:

```
[您的姓名] (text* your-name)
[您的邮箱] (email* your-email)
[电话] (tel your-phone)
[主题] (select* your-subject
    "Consulta General"
    "Información sobre Masonería"
    "Eventos"
    "Otro"
)
[您的消息] (textarea* your-message)
[发送] (submit "Enviar Mensaje")
```

**Configurar email**:
- Para: admin@virtudyvictoria277.com
- Asunto: [Virtud y Victoria] - %your-subject%
- De: %your-name% <%your-email%>

### Wordfence Security

**Firewall → Escaneo Inicial**:
- Ejecutar escaneo inicial

**Login Security**:
- Habilitar 2FA para admin
- Limitar intentos de login: 5
- Bloqueo después de 5 intentos: 300 segundos

### WP Super Cache

**Easy**:
- Activar caché: ✅

**Advanced**:
- Caché para visitantes: ✅
- Caché para dispositivos móviles: ✅
- Caché para usuarios logueados: ❌

### The Events Calendar

**General**:
- Moneda: USD
- Zona horaria: America/Caracas
- Formato de fecha: d/m/Y

**Display**:
- Mostrar eventos en: /eventos/
- Eventos por página: 10

---

## Configuración de Custom Post Types

### Eventos (CPT: evento)

**Campos Personalizados**:
| Campo | Tipo | Obligatorio |
|-------|------|-------------|
| Fecha del evento | Date | Sí |
| Hora del evento | Time | No |
| Lugar del evento | Text | No |
| Tipo de evento | Select | Sí |
| URL de inscripción | URL | No |

**Tipos de evento disponibles**:
- Tenida
- Ceremonia
- Evento Social
- Filantropía
- Otro

### Masones Célebres (CPT: mason_celebre)

**Campos**:
- Título: Nombre del masón
- Contenido: Biografía
- Imagen destacada: Foto

### Galerías (CPT: galeria)

**Taxonomía**: Álbumes (album_galeria)
- Tenidas 2026
- Ceremonias
- Eventos Sociales
- Filantropía
- Templo

---

## Configuración de Seguridad

### wp-config.php (Recomendado)

```php
// Forzar SSL en admin
define('FORCE_SSL_ADMIN', true);

// Limitar revisiones
define('WP_POST_REVISIONS', 5);

// Desactivar editor de archivos
define('DISALLOW_FILE_EDIT', true);
```

### .htaccess (Recomendado)

```apache
# Headers de seguridad
<IfModule mod_headers.c>
    Header set X-Content-Type-Options "nosniff"
    Header set X-Frame-Options "SAMEORIGIN"
    Header set X-XSS-Protection "1; mode=block"
    Header set Referrer-Policy "strict-origin-when-cross-origin"
</IfModule>
```

---

## Configuración de Email (SMTP)

Si el formulario de contacto no envía emails, configurar SMTP:

### Opción 1: WP Mail SMTP

1. Instalar plugin "WP Mail SMTP"
2. Configurar:
   - SMTP Host: smtp.gmail.com
   - SMTP Port: 587
   - Encryption: TLS
   - Username: tu-email@gmail.com
   - Password: [App Password de Google]

### Opción 2: WP Mail SMTP con PHPMailer

```php
// En wp-config.php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'tu-email@gmail.com');
define('SMTP_PASS', '[App Password]');
```

---

## Configuración de Redes Sociales

### Facebook

1. Crear página de la logia en Facebook
2. Agregar URL en Customizer → Información de la Logia → URL Facebook
3. Agregar meta tag de verificación en Yoast SEO → Social

### Instagram

1. Crear cuenta de Instagram
2. Agregar URL en Customizer → Información de la Logia → URL Instagram

---

## Configuración de Analytics

### Google Analytics

1. Crear cuenta en Google Analytics
2. Obtener ID de medición (G-XXXXXXXXXX)
3. Agregar en Yoast SEO → General → Webmaster Tools
4. O agregar manualmente en header.php:

```html
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-XXXXXXXXXX');
</script>
```

### Google Search Console

1. Registrar sitio en Google Search Console
2. Agregar meta tag de verificación en Yoast SEO → General → Webmaster Tools
3. Subir sitemap: `https://tusitio.com/sitemap_index.xml`

---

## Configuración de Backups

### UpdraftPlus

1. Instalar UpdraftPlus
2. Ir a **Ajustes → UpdraftPlus Backups**
3. Configurar:
   - Copia de seguridad automática: Cada 14 días
   - Almacenar en: Google Drive / Dropbox
   - Archivos a respaldar: Plugins, Temas, Base de datos
   - Mantener: 2 copias

---

## Solución de Problemas

### El formulario no envía emails
- Verificar configuración SMTP
- Probar con WP Mail SMTP
- Revisar logs de correo del servidor

### El hero slider no rota
- Verificar que main.js se carga correctamente
- Revisar consola del navegador (F12)
- Verificar que los slides tienen contenido

### Los estilos no se aplican
- Verificar que custom.css se carga
- Revisar rutas en functions.php
- Limpiar caché del navegador

### Los breadcrumbs no aparecen
- Verificar que vyv_breadcrumb() está en functions.php
- Revisar que se usa en los templates

---

*Guía actualizada: 26 de agosto de 2026*

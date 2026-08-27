# 🔧 Guía de Mantenimiento - Virtud y Victoria Nº 277

> **Propósito de este documento**: Rutinas de mantenimiento periódico, procedimientos de backup, monitoreo de seguridad, optimización de rendimiento y solución de problemas comunes. Consultar para tareas de mantenimiento regulares.

## Mantenimiento Regular

### Diario
- [ ] Verificar que el sitio está accesible
- [ ] Revisar formularios recibidos (Contact Form 7)
- [ ] Responder consultas pendientes

### Semanal
- [ ] Publicar noticias/entradas de blog
- [ ] Agregar eventos próximos al calendario
- [ ] Responder comentarios
- [ ] Verificar estadísticas básicas (Analytics)

### Mensual
- [ ] Actualizar WordPress (si hay nueva versión)
- [ ] Actualizar plugins
- [ ] Revisar reporte de Analytics
- [ ] Verificar backups
- [ ] Revisar seguridad (Wordfence)
- [ ] Optimizar imágenes subidas
- [ ] Revisar enlaces rotos

### Trimestral
- [ ] Auditoría completa de seguridad
- [ ] Revisión de rendimiento (Lighthouse)
- [ ] Actualización de contenido estático
- [ ] Revisión de SEO (Yoast)
- [ ] Pruebas de formularios
- [ ] Verificar responsive en nuevos dispositivos

### Anual
- [ ] Revisión completa del sitio
- [ ] Actualización de textos institucionales
- [ ] Renovación de dominio
- [ ] Renovación de hosting
- [ ] Revisión de plugins (eliminar innecesarios)
- [ ] Actualización de fotos/imágenes

---

## Actualizaciones de WordPress

### Antes de Actualizar

1. **Crear backup completo** (UpdraftPlus)
2. **Verificar compatibilidad** de plugins
3. **Revisar changelog** de WordPress
4. **Actualizar en staging** primero (si es posible)

### Proceso de Actualización

```bash
# Vía WP-CLI (recomendado)
wp core update
wp core update-db
wp plugin update --all
wp theme update --all
```

### Vía Admin

1. Ir a **Dashboard → Actualizaciones**
2. Actualizar WordPress core
3. Actualizar plugins uno por uno
4. Actualizar tema si hay nueva versión

### Después de Actualizar

- [ ] Verificar que el sitio carga correctamente
- [ ] Probar formulario de contacto
- [ ] Verificar que los CPTs funcionan
- [ ] Probar hero slider
- [ ] Verificar breadcrumbs
- [ ] Revisar consola del navegador (F12)

---

## Backups

### Con UpdraftPlus

**Crear backup manual**:
1. Ir a **Ajustes → UpdraftPlus Backups**
2. Hacer clic en **"Hacer copia de seguridad ahora"**
3. Seleccionar: Archivos + Base de datos
4. Esperar a que termine

**Restaurar backup**:
1. Ir a **Ajustes → UpdraftPlus Backups**
2. Seleccionar backup a restaurar
3. Hacer clic en **"Restaurar"**
4. Seguir instrucciones

### Backup Manual via WP-CLI

```bash
# Backup de base de datos
wp db export backup-$(date +%Y%m%d).sql

# Backup de archivos
tar -czf backup-$(date +%Y%m%d).tar.gz wp-content/

# Restaurar base de datos
wp db import backup-20260826.sql
```

### Backup Manual via SSH

```bash
# Backup completo
mysqldump -u user -p database > backup.sql
tar -czf backup.tar.gz /path/to/wordpress/

# Restaurar
mysql -u user -p database < backup.sql
tar -xzf backup.tar.gz -C /path/to/wordpress/
```

---

## Monitoreo

### Google Analytics

**Métricas importantes**:
| Métrica | Objetivo | Acción si falla |
|---------|----------|-----------------|
| Visitas mensuales | Crecimiento 10% | Revisar SEO, contenido |
| Tiempo de carga | < 3s | Optimizar imágenes, caché |
| Tasa de rebote | < 50% | Mejorar contenido, diseño |
| Páginas/sesión | > 2 | Mejorar navegación |

### Google Search Console

**Revisar semanalmente**:
- Errores de rastreo
- Páginas indexadas
- Consultas de búsqueda
- Errores de móvil

### Uptime Monitoring

Herramientas recomendadas:
- **UptimeRobot** (gratis): uptime_robot.com
- **Pingdom** (gratis limitado): pingdom.com
- **GTmetrix**: gtmetrix.com

---

## Seguridad

### Wordfence

**Revisar semanalmente**:
- Escaneo de malware
- Intentos de login fallidos
- IPs bloqueadas
- Firewall status

**Configuración recomendada**:
- Escaneo automático: Semanal
- Actualizaciones de firewall: Automáticas
- Login limitado: 5 intentos
- Bloqueo: 5 minutos

### Hardening

**Verificar mensualmente**:
- [ ] WordPress actualizado
- [ ] Plugins actualizados
- [ ] Tema actualizado
- [ ] Contraseñas fuertes
- [ ] 2FA habilitado para admin
- [ ] XML-RPC deshabilitado (si no se usa)
- [ ] Login de usuarios deshabilitado (si no se necesita)

**Deshabilitar XML-RPC** (en .htaccess):
```apache
<Files xmlrpc.php>
    Order Deny,Allow
    Deny from all
</Files>
```

---

## Rendimiento

### Optimización de Imágenes

**Antes de subir**:
- Formato: WebP o JPEG
- Tamaño máximo: 1920x1080 (hero), 800x600 (contenido)
- Compresión: 80-85%

**Herramientas**:
- TinyPNG: tinypng.com
- Squoosh: squoosh.app
- ShortPixel (plugin)

### Caché

**WP Super Cache**:
- Verificar que está activo
- Limpiar caché después de actualizaciones
- No cachear para usuarios logueados

### Lazy Loading

Ya implementado en `main.js` con IntersectionObserver.

---

## Solución de Problemas Comunes

### Sitio lento

1. Verificar caché activo
2. Optimizar imágenes
3. Minificar CSS/JS (WP Super Cache)
4. Verificar plugins pesados
5. Revisar hosting

### Formulario no funciona

1. Verificar que CF7 está activo
2. Revisar configuración de email
3. Probar SMTP (WP Mail SMTP)
4. Revisar logs de error

### Imágenes no cargan

1. Verificar rutas de imágenes
2. Revisar permisos (644/755)
3. Verificar límites de PHP (upload_max_filesize)
4. Comprimir imágenes

### Errores 500

1. Revisar `wp-config.php`
2. Verificar logs de error de PHP
3. Desactivar plugins uno por uno
4. Cambiar temporalmente al tema por defecto

### Slider no funciona

1. Verificar que `main.js` se carga
2. Revisar consola del navegador (F12)
3. Verificar que los slides tienen contenido
4. Probar en modo incógnito

---

## CONTACTOS

### Desarrollador
- **Nombre**: [Nombre del desarrollador]
- **Email**: [email]
- **Teléfono**: [teléfono]

### Hosting
- **Proveedor**: [Nombre del hosting]
- **Panel**: [URL del panel]
- **Soporte**: [Contacto del soporte]

### Dominio
- **Registrador**: [Nombre del registrador]
- **Panel**: [URL del panel]
- **Vencimiento**: [Fecha]

---

## RECORDATORIOS IMPORTANTES

```
📅 Cada 14 días:
   - Backup automático (UpdraftPlus)

📅 Cada mes:
   - Actualizar WordPress y plugins
   - Revisar Analytics
   - Verificar backups

📅 Cada 3 meses:
   - Auditoría de seguridad
   - Revisión de rendimiento

📅 Cada año:
   - Renovar dominio
   - Renovar hosting
   - Revisión completa del sitio
```

---

*Guía actualizada: 26 de agosto de 2026*

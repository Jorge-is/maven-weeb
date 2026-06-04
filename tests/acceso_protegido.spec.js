const { test, expect } = require('@playwright/test');

// Verifica que las páginas privadas rechacen acceso sin sesión activa.

test.describe('Acceso protegido - sin sesión', () => {
  test('cliente/index.php redirige a iniciar_sesion.php', async ({ page }) => {
    await page.goto('cliente/index.php');
    await expect(page).toHaveURL(/iniciar_sesion\.php/);
  });

  test('cliente/servicios.php redirige a iniciar_sesion.php', async ({ page }) => {
    await page.goto('cliente/servicios.php');
    await expect(page).toHaveURL(/iniciar_sesion\.php/);
  });

  test('cliente/cotizacion.php redirige a iniciar_sesion.php', async ({ page }) => {
    await page.goto('cliente/cotizacion.php');
    await expect(page).toHaveURL(/iniciar_sesion\.php/);
  });

  test('administrador/intranet.php redirige al login de admin', async ({ page }) => {
    await page.goto('administrador/intranet.php');
    await expect(page).toHaveURL(/administrador\/index\.php/);
  });

  test('administrador/clientes_administrador.php redirige al login de admin', async ({ page }) => {
    await page.goto('administrador/clientes_administrador.php');
    await expect(page).toHaveURL(/administrador\/index\.php/);
  });

  test('editor/intranet.php redirige fuera del área privada', async ({ page }) => {
    await page.goto('editor/intranet.php');
    // El editor redirige al index público cuando no hay sesión
    await expect(page).not.toHaveURL(/editor\/intranet\.php/);
  });
});

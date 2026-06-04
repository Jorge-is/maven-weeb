const { test, expect } = require('@playwright/test');
const { CREDENCIALES } = require('./helpers');

// ─── Cliente ──────────────────────────────────────────────────────────────────
test.describe('Auth - Cliente', () => {
  test('login exitoso redirige al dashboard', async ({ page }) => {
    await page.goto('iniciar_sesion.php');
    await page.fill('#usuario', CREDENCIALES.cliente.usuario);
    await page.fill('#clave', CREDENCIALES.cliente.clave);
    await page.click('button[type="submit"]');
    await page.waitForURL('**/cliente/index.php**', { timeout: 8000 });
    await expect(page).toHaveURL(/cliente\/index\.php/);
  });

  test('credenciales incorrectas muestran error', async ({ page }) => {
    await page.goto('iniciar_sesion.php');
    await page.fill('#usuario', 'usuario_falso');
    await page.fill('#clave', 'clave_falsa');
    await page.click('button[type="submit"]');
    await expect(page).toHaveURL(/mensaje=error/);
    await expect(page.locator('.swal2-popup')).toBeVisible();
  });

  test('usuario autenticado no puede volver a iniciar_sesion.php', async ({ page }) => {
    await page.goto('iniciar_sesion.php');
    await page.fill('#usuario', CREDENCIALES.cliente.usuario);
    await page.fill('#clave', CREDENCIALES.cliente.clave);
    await page.click('button[type="submit"]');
    await page.waitForURL('**/cliente/index.php**', { timeout: 8000 });

    await page.goto('iniciar_sesion.php');
    await expect(page).not.toHaveURL(/iniciar_sesion\.php/);
  });
});

// ─── Admin ────────────────────────────────────────────────────────────────────
test.describe('Auth - Admin', () => {
  test('login exitoso redirige a intranet', async ({ page }) => {
    await page.goto('administrador/index.php');
    await page.fill('#usuario', CREDENCIALES.admin.usuario);
    await page.fill('#clave', CREDENCIALES.admin.clave);
    await page.click('button[type="submit"]');
    await page.waitForURL('**/administrador/intranet.php**', { timeout: 8000 });
    await expect(page).toHaveURL(/administrador\/intranet\.php/);
  });

  test('credenciales incorrectas muestran error', async ({ page }) => {
    await page.goto('administrador/index.php');
    await page.fill('#usuario', 'usuario_falso');
    await page.fill('#clave', 'clave_falsa');
    await page.click('button[type="submit"]');
    await expect(page).toHaveURL(/mensaje=error/);
    await expect(page.locator('.swal2-popup')).toBeVisible();
  });

  test('usuario autenticado no puede volver al login de admin', async ({ page }) => {
    await page.goto('administrador/index.php');
    await page.fill('#usuario', CREDENCIALES.admin.usuario);
    await page.fill('#clave', CREDENCIALES.admin.clave);
    await page.click('button[type="submit"]');
    await page.waitForURL('**/administrador/intranet.php**', { timeout: 8000 });

    await page.goto('administrador/index.php');
    await expect(page).not.toHaveURL(/administrador\/index\.php/);
  });
});

// ─── Editor ───────────────────────────────────────────────────────────────────
test.describe('Auth - Editor', () => {
  test('login exitoso redirige a intranet', async ({ page }) => {
    await page.goto('editor/index.php');
    await page.fill('#usuario', CREDENCIALES.editor.usuario);
    await page.fill('#clave', CREDENCIALES.editor.clave);
    await page.click('button[type="submit"]');
    await page.waitForURL('**/editor/intranet.php**', { timeout: 8000 });
    await expect(page).toHaveURL(/editor\/intranet\.php/);
  });

  test('credenciales incorrectas muestran error', async ({ page }) => {
    await page.goto('editor/index.php');
    await page.fill('#usuario', 'usuario_falso');
    await page.fill('#clave', 'clave_falsa');
    await page.click('button[type="submit"]');
    await expect(page).toHaveURL(/mensaje=error/);
    await expect(page.locator('.swal2-popup')).toBeVisible();
  });

  test('usuario autenticado no puede volver al login de editor', async ({ page }) => {
    await page.goto('editor/index.php');
    await page.fill('#usuario', CREDENCIALES.editor.usuario);
    await page.fill('#clave', CREDENCIALES.editor.clave);
    await page.click('button[type="submit"]');
    await page.waitForURL('**/editor/intranet.php**', { timeout: 8000 });

    await page.goto('editor/index.php');
    await expect(page).not.toHaveURL(/editor\/index\.php/);
  });
});

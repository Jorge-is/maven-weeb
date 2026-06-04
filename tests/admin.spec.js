const { test, expect } = require('@playwright/test');
const { loginAdmin } = require('./helpers');

test.describe('Dashboard - Admin', () => {
  test.beforeEach(async ({ page }) => {
    await loginAdmin(page);
  });

  test('muestra mensaje de bienvenida en intranet', async ({ page }) => {
    await expect(page.locator('h1')).toContainText(/bienvenido/i);
  });

  test('tiene título correcto', async ({ page }) => {
    await expect(page).toHaveTitle(/intranet/i);
  });

  test('clientes_administrador.php carga correctamente', async ({ page }) => {
    await page.goto('administrador/clientes_administrador.php');
    await expect(page).toHaveURL(/clientes_administrador\.php/);
    await expect(page.locator('main')).toBeVisible();
  });

  test('editores_administrador.php carga correctamente', async ({ page }) => {
    await page.goto('administrador/editores_administrador.php');
    await expect(page).toHaveURL(/editores_administrador\.php/);
    await expect(page.locator('main')).toBeVisible();
  });

  test('blogs_gestionar.php carga correctamente', async ({ page }) => {
    await page.goto('administrador/blogs_gestionar.php');
    await expect(page).toHaveURL(/blogs_gestionar\.php/);
    await expect(page.locator('main')).toBeVisible();
  });

  test('servicios_gestionar.php carga correctamente', async ({ page }) => {
    await page.goto('administrador/servicios_gestionar.php');
    await expect(page).toHaveURL(/servicios_gestionar\.php/);
    await expect(page.locator('main')).toBeVisible();
  });

  test('mensajes_administrador.php carga correctamente', async ({ page }) => {
    await page.goto('administrador/mensajes_administrador.php');
    await expect(page).toHaveURL(/mensajes_administrador\.php/);
    await expect(page.locator('main')).toBeVisible();
  });

  test('cerrar sesión redirige fuera de admin', async ({ page }) => {
    await page.goto('administrador/cerrar_sesion.php');
    await expect(page).not.toHaveURL(/administrador\/intranet\.php/);
  });

  test('después de cerrar sesión no puede acceder a intranet', async ({ page }) => {
    await page.goto('administrador/cerrar_sesion.php');
    await page.goto('administrador/intranet.php');
    await expect(page).toHaveURL(/administrador\/index\.php/);
  });
});

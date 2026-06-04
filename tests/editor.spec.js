const { test, expect } = require('@playwright/test');
const { loginEditor } = require('./helpers');

test.describe('Dashboard - Editor', () => {
  test.beforeEach(async ({ page }) => {
    await loginEditor(page);
  });

  test('muestra mensaje de bienvenida en intranet', async ({ page }) => {
    await expect(page.locator('h1')).toContainText(/bienvenido/i);
  });

  test('tiene título correcto', async ({ page }) => {
    await expect(page).toHaveTitle(/intranet/i);
  });

  test('inicio_gestionar.php carga correctamente', async ({ page }) => {
    await page.goto('editor/inicio_gestionar.php');
    await expect(page).toHaveURL(/inicio_gestionar\.php/);
    await expect(page.locator('main')).toBeVisible();
  });

  test('proyecto_gestionar.php carga correctamente', async ({ page }) => {
    await page.goto('editor/proyecto_gestionar.php');
    await expect(page).toHaveURL(/proyecto_gestionar\.php/);
    await expect(page.locator('main')).toBeVisible();
  });

  test('cerrar sesión redirige fuera del área de editores', async ({ page }) => {
    await page.goto('editor/cerrar_sesion.php');
    await expect(page).not.toHaveURL(/editor\/intranet\.php/);
  });

  test('después de cerrar sesión no puede acceder a intranet', async ({ page }) => {
    await page.goto('editor/cerrar_sesion.php');
    await page.goto('editor/intranet.php');
    await expect(page).not.toHaveURL(/editor\/intranet\.php/);
  });
});

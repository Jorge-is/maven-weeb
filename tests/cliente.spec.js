const { test, expect } = require('@playwright/test');
const { loginCliente } = require('./helpers');

test.describe('Dashboard - Cliente', () => {
  test.beforeEach(async ({ page }) => {
    await loginCliente(page);
  });

  test('muestra mensaje de bienvenida con nombre del usuario', async ({ page }) => {
    await expect(page.locator('h1')).toContainText(/bienvenido/i);
  });

  test('tiene título correcto', async ({ page }) => {
    await expect(page).toHaveTitle(/intranet/i);
  });

  test('servicios.php carga correctamente estando autenticado', async ({ page }) => {
    await page.goto('cliente/servicios.php');
    await expect(page).toHaveURL(/cliente\/servicios\.php/);
    await expect(page.locator('main')).toBeVisible();
  });

  test('cotizacion.php carga correctamente estando autenticado', async ({ page }) => {
    await page.goto('cliente/cotizacion.php');
    await expect(page).toHaveURL(/cliente\/cotizacion\.php/);
    await expect(page.locator('main')).toBeVisible();
  });

  test('cerrar sesión redirige al login público', async ({ page }) => {
    await page.goto('cliente/cerrar_sesion.php');
    await expect(page).toHaveURL(/iniciar_sesion\.php|index\.php/);
  });

  test('después de cerrar sesión no puede acceder al dashboard', async ({ page }) => {
    await page.goto('cliente/cerrar_sesion.php');
    await page.goto('cliente/index.php');
    await expect(page).toHaveURL(/iniciar_sesion\.php/);
  });
});

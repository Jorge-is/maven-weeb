// Reemplazado por tests/autenticacion.spec.js — este archivo se mantiene
// como smoke test básico del formulario de login público.
const { test, expect } = require('@playwright/test');

test.describe('Login (smoke)', () => {
  test('muestra el formulario de login', async ({ page }) => {
    await page.goto('iniciar_sesion.php');
    await expect(page.locator('#usuario')).toBeVisible();
    await expect(page.locator('#clave')).toBeVisible();
    await expect(page.locator('button[type="submit"]')).toBeVisible();
  });

  test('credenciales incorrectas muestran alerta de error', async ({ page }) => {
    await page.goto('iniciar_sesion.php');
    await page.fill('#usuario', 'usuario_falso');
    await page.fill('#clave', 'clave_falsa');
    await page.click('button[type="submit"]');
    await expect(page).toHaveURL(/mensaje=error/);
    await expect(page.locator('.swal2-popup')).toBeVisible();
  });
});

const { test, expect } = require('@playwright/test');

const PAGINAS = [
  { url: 'index.php',        titulo: /WEEB MAVEN/i },
  { url: 'proyectos.php',    titulo: /proyectos/i  },
  { url: 'servicios.php',    titulo: /servicios/i  },
  { url: 'conocenos.php',    titulo: /conoc/i      },
  { url: 'contactenos.php',  titulo: /cont/i       },
  { url: 'blog.php',         titulo: /blog/i       },
];

test.describe('Páginas públicas', () => {
  for (const pagina of PAGINAS) {
    test(`${pagina.url} carga sin error`, async ({ page }) => {
      const response = await page.goto(pagina.url);
      expect(response.status()).toBeLessThan(400);
      await expect(page.locator('main')).toBeVisible();
    });
  }

  test('iniciar_sesion.php muestra formulario completo', async ({ page }) => {
    await page.goto('iniciar_sesion.php');
    await expect(page.locator('#usuario')).toBeVisible();
    await expect(page.locator('#clave')).toBeVisible();
    await expect(page.locator('button[type="submit"]')).toBeVisible();
    await expect(page.locator('a[href="registro.php"]')).toBeVisible();
  });

  test('registro.php muestra formulario', async ({ page }) => {
    await page.goto('registro.php');
    await expect(page.locator('form')).toBeVisible();
    await expect(page.locator('button[type="submit"]')).toBeVisible();
  });

  test('navegación principal tiene los links esperados', async ({ page }) => {
    await page.goto('index.php');
    await expect(page.locator('nav')).toBeVisible();
    await expect(page.locator('a[href*="iniciar_sesion"]')).toBeVisible();
  });

  test('página de contacto tiene formulario de contacto', async ({ page }) => {
    await page.goto('contactenos.php');
    await expect(page.locator('form')).toBeVisible();
  });
});

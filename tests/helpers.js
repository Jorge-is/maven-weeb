const CREDENCIALES = {
  cliente: { usuario: 'Jorge', clave: 'jorge1234' },
  admin:   { usuario: 'jorge', clave: 'jorge1234' },
  editor:  { usuario: 'jorge', clave: 'jorge1234' },
};

async function loginCliente(page) {
  await page.goto('iniciar_sesion.php');
  await page.fill('#usuario', CREDENCIALES.cliente.usuario);
  await page.fill('#clave', CREDENCIALES.cliente.clave);
  await page.click('button[type="submit"]');
  await page.waitForURL('**/cliente/index.php**', { timeout: 8000 });
}

async function loginAdmin(page) {
  await page.goto('administrador/index.php');
  await page.fill('#usuario', CREDENCIALES.admin.usuario);
  await page.fill('#clave', CREDENCIALES.admin.clave);
  await page.click('button[type="submit"]');
  await page.waitForURL('**/administrador/intranet.php**', { timeout: 8000 });
}

async function loginEditor(page) {
  await page.goto('editor/index.php');
  await page.fill('#usuario', CREDENCIALES.editor.usuario);
  await page.fill('#clave', CREDENCIALES.editor.clave);
  await page.click('button[type="submit"]');
  await page.waitForURL('**/editor/intranet.php**', { timeout: 8000 });
}

module.exports = { CREDENCIALES, loginCliente, loginAdmin, loginEditor };

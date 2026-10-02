<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/Nucleo/ayudantes.php';

session_start();

use App\Nucleo\Router;
use App\Nucleo\Conexion;
use App\Repositorios\RepositorioCuentas;
use App\Repositorios\RepositorioUsuarios;
use App\Repositorios\RepositorioRetiros;
use App\Repositorios\RepositorioTransferencias;
use App\Servicios\ServicioAutenticacion;
use App\Servicios\ServicioRetiros;
use App\Servicios\ServicioTransferencias;
use App\Controladores\ControladorSesion;
use App\Controladores\ControladorCuenta;
use App\Controladores\ControladorRetiros;
use App\Controladores\ControladorTransferencias;

$pdo = Conexion::obtener();

$repoCuentas = new RepositorioCuentas($pdo);
$repoUsuarios = new RepositorioUsuarios($pdo);
$repoRetiros = new RepositorioRetiros($pdo);
$repoTransferencias = new RepositorioTransferencias($pdo);

$servicioAuth = new ServicioAutenticacion($repoCuentas, $repoUsuarios);
$servicioRetiros = new ServicioRetiros($repoCuentas, $repoUsuarios, $repoRetiros);
$servicioTransferencias = new ServicioTransferencias($pdo, $repoCuentas, $repoUsuarios, $repoTransferencias);

$controladorSesion = new ControladorSesion($servicioAuth);
$controladorCuenta = new ControladorCuenta($repoCuentas);
$controladorRetiros = new ControladorRetiros($servicioRetiros, $repoRetiros);
$controladorTransferencias = new ControladorTransferencias($servicioTransferencias, $repoTransferencias);

$router = new Router();

$router->agregar('login', function () use ($controladorSesion) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controladorSesion->procesarLogin();
    } else {
        $controladorSesion->mostrarLogin();
    }
});

$router->agregar('panel', function () use ($controladorCuenta) {
    $controladorCuenta->mostrarPanel();
});

$router->agregar('retiro', function () use ($controladorRetiros) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controladorRetiros->procesarRetiro();
    } else {
        $controladorRetiros->mostrarFormulario();
    }
});

$router->agregar('historial_retiros', function () use ($controladorRetiros) {
    $controladorRetiros->mostrarHistorial();
});

$router->agregar('transferencia', function () use ($controladorTransferencias) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controladorTransferencias->procesarTransferencia();
    } else {
        $controladorTransferencias->mostrarFormulario();
    }
});

$router->agregar('historial_transferencias', function () use ($controladorTransferencias) {
    $controladorTransferencias->mostrarHistorial();
});

$router->agregar('logout', function () {
    session_destroy();
    header('Location: index.php?ruta=login');
    exit;
});

$rutaActual = $_GET['ruta'] ?? 'login';

$router->despachar($rutaActual);
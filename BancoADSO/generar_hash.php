<?php
$contrasenas = ['clave123', 'clave123', 'clave123', 'clave123', 'clave123'];

foreach ($contrasenas as $i => $clave) {
    echo "Usuario " . ($i + 1) . ": " . password_hash($clave, PASSWORD_DEFAULT) . "\n";
}
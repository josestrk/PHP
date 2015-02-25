<?php
function checkfile($file){
    $permisos = fileperms($file);

    if (($permisos & 0xC000) == 0xC000) {
        // Socket
        $info = 's';
    } elseif (($permisos & 0xA000) == 0xA000) {
        // Enlace Simbólico
        $info = 'l';
    } elseif (($permisos & 0x8000) == 0x8000) {
        // Regular
        $info = 'file';
    } elseif (($permisos & 0x6000) == 0x6000) {
        // Especial Bloque
        $info = 'b';
    } elseif (($permisos & 0x4000) == 0x4000) {
        // Directorio
        $info = 'd';
    } elseif (($permisos & 0x2000) == 0x2000) {
        // Especial Carácter
        $info = 'c';
    } elseif (($permisos & 0x1000) == 0x1000) {
        // Tubería FIFO
        $info = 'p';
    } else {
        // Desconocido
        $info = 'u';
    }
    return $info;
}
function checkperm($file){
    $permisos = fileperms($file);
    // Propietario
    $info = (($permisos & 0x0100) ? 'r' : '-');
    $info .= (($permisos & 0x0080) ? 'w' : '-');
    $info .= (($permisos & 0x0040) ?
                (($permisos & 0x0800) ? 's' : 'x' ) :
                (($permisos & 0x0800) ? 'S' : '-'));

    // Grupo
    $info .= (($permisos & 0x0020) ? 'r' : '-');
    $info .= (($permisos & 0x0010) ? 'w' : '-');
    $info .= (($permisos & 0x0008) ?
                (($permisos & 0x0400) ? 's' : 'x' ) :
                (($permisos & 0x0400) ? 'S' : '-'));

    // Mundo
    $info .= (($permisos & 0x0004) ? 'r' : '-');
    $info .= (($permisos & 0x0002) ? 'w' : '-');
    $info .= (($permisos & 0x0001) ?
                (($permisos & 0x0200) ? 't' : 'x' ) :
                (($permisos & 0x0200) ? 'T' : '-'));

    return $info;
}
?>
<?php

if (!function_exists('hasPermission')) {
    function hasPermission($requiredPermissions) {
        $user = auth()->user();
        if (!$user) return false;

        // Mapeo de roles a permisos (id_rol => [permisos])
        $rolePermissions = [
            1  => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11], // Admin
            2  => [1, 2, 3, 5, 6, 7],                  // Gerente Inventarios
            3  => [1, 2, 3, 4, 7],                     // Encargado Almacén
            4  => [1, 2, 3, 4, 8],                     // Oficial Compras
            5  => [1, 2, 3, 4, 7],                     // Coordinador Logística
            6  => [2, 5, 7],                           // Analista Costos
            7  => [1, 2, 3, 4, 9, 11],                    // Gestor RH
            8  => [2, 7],                              // Auditor
        ];

        $userPermissions = $rolePermissions[$user->id_rol] ?? [];

        // Si es arreglo, verificar si hay intersección
        if (is_array($requiredPermissions)) {
            return !empty(array_intersect($userPermissions, $requiredPermissions));
        }

        // Si es un único permiso
        return in_array($requiredPermissions, $userPermissions);
    }
}
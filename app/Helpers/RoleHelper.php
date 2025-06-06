<?php

if (!function_exists('showMenuItem')) {
    function showMenuItem($roleIds, $routeName) {
        $userRole = auth()->user()->id_rol;
        return in_array($userRole, (array)$roleIds) ? '' : 'd-none';
    }
}
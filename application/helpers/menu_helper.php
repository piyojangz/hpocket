<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('is_menu_active')) {

    function is_menu_active($str_menu, $current_menu, $more = "") {
        $result = "";
        if ($str_menu == $current_menu) {
            $result = 'class="active ' . $more . '" ';
        }
        return $result;
    }

}
<?php



if (!function_exists('format_datetime')) {

    function format_datetime($date, $format = 'd/m/Y H:i'): string
    {
        return $date ? \Carbon\Carbon::parse($date)->format($format) : '';
    }
}

if (!function_exists('format_price')) {

    function format_price($price): string
    {
        return number_format($price, 2, ',', ' ') . ' €';
    }
}

if (!function_exists('format_price_dt')) {

    function format_price_dt($price): string
    {
        if (!$price || $price <= 0) {
            return 'Free';
        }
        return number_format((float)$price, 2, '.', ' ') . ' DT';
    }
}

if (!function_exists('storage_url')) {

    function storage_url($path): string
    {
        return $path ? asset('storage/' . $path) : '';
    }
}

if (!function_exists('event_status_badge')) {

    function event_status_badge($status): string
    {
        $badges = [
            'active' => '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Actif</span>',
            'archived' => '<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Archivé</span>',
        ];
        
        return $badges[$status] ?? '';
    }
}

if (!function_exists('user_avatar')) {

    function user_avatar($name, $size = 40): string
    {
        return "https://ui-avatars.com/api/?name=" . urlencode($name) . "&background=8b5cf6&color=fff&size={$size}";
    }
}

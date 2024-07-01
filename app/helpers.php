<?php

if (!function_exists('public_asset')) {
    /**
     * Generate a URL for an asset including the public directory.
     *
     * @param string $path
     * @param bool $secure
     * @return string
     */
    function public_asset($path, $secure = null)
    {
        return app('url')->asset('public/' . $path, $secure);
    }
}

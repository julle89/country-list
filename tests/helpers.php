<?php

if (!function_exists('base_path')) {

    /**
     * Get the path to the root of the codebase.
     *
     * @param  string $path
     * @return string
     */
    function base_path($path = '') {
        $basePath = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;
        return $basePath . $path;
    }
}

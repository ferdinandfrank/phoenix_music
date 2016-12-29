<?php

/**
 * Builds a json error response.
 *
 * @param null $message
 *
 * @return array
 */
function getJsonError($message = null) {
    if (empty($message)) {
        $message = Lang::get('error.unknown');
    }

    return ['msg' => $message];
}

/**
 * Gets the path to the public storage.
 *
 * @param string $filename The filename to append to the path. Can be {@code null}.
 *
 * @return string The path to the public storage.
 */
function public_storage_path($filename = null) {
    $publicStoragePath = Config::get('filesystems.disks.public.root');
    if (empty($filename)) {
        return $publicStoragePath;
    }

    // Check if filename has params
    $filename = removeQueryString($filename);

    $storageName = "/storage/";
    if (substr($filename, 0, strlen($storageName)) == $storageName) {
        $filename = substr($filename, strlen($storageName));
    }

    return $publicStoragePath . '/' . $filename;
}

/**
 * Removes the query parameters from the specified string.
 *
 * @param string $string The string where to remove the query parameters.
 *
 * @return string The specified string without any query parameters.
 */
function removeQueryString($string) {
    $queryPosition = strrpos($string, "?");
    if ($queryPosition !== false) {
        return substr($string, 0, $queryPosition);
    }

    return $string;
}

/**
 * Checks if the current path is the path of the specified key's route.
 *
 * @param string $routeKey The key of the route to check.
 *
 * @return bool {@code true} if the current path is equal to the specified key's route.
 */
function isRoute($routeKey) {
    return Request::url() == route($routeKey);
}


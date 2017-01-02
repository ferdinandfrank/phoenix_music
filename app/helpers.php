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
 * @param bool   $recursive {@code false} if also child routes shall be checked
 *
 * @return bool if the current path is equal to the specified key's route.
 * if the current path is equal to the specified key's route.
 */
function isRoute($routeKey, $recursive = false) {
    $routeValue = route($routeKey);
    $currentRoute = Request::url();
    if (!$recursive) {
        return $routeValue === $currentRoute;
    }

    return substr($currentRoute, 0, strlen($routeValue)) === $routeValue;
}

/**
 * Localizes the current requested path to the specified locale.
 *
 * @param null|string $locale
 *
 * @return string
 */
function localizeRoute($locale = null) {
    $path = Request::path();
    $currentLocale = App::getLocale();
    $defaultLocale = config('app.fallback_locale');

    if (substr($path, 0, strlen($currentLocale)) == $currentLocale) {
        $path = substr($path, strlen($currentLocale));
    }

    if ($locale != $defaultLocale && !empty($locale) && array_key_exists($locale, config('app.locales'))) {
        $path = $locale . '/' . $path;
    }

    if (substr($path, 0, 1) != '/') {
        $path = '/' . $path;
    }

    return $path;
}

/**
 * Format the carbon instance as an localized date string.
 *
 * @param \Carbon\Carbon $date
 *
 * @return string
 */
function toDateString(\Carbon\Carbon $date) {
    if ($date->isToday()) {
        return Lang::get('date.today');
    } elseif ($date->isTomorrow()) {
        return Lang::get('date.tomorrow');
    } elseif ($date->isYesterday()) {
        return Lang::get('date.yesterday');
    }

    return $date->formatLocalized('%d %B %Y');
}

<?php

namespace App\Utils;

/**
 * UrlGenerator
 * -----------------------
 * Generates urls to specific pages.
 *
 * @author Ferdinand Frank
 * @version 1.0
 * @package App\Utils
 */
class UrlGenerator {

    /**
     * Creates the url to a facebook page.
     *
     * @param $slug
     * @return string
     */
    public static function facebook($slug) {
        return "http://facebook.com/$slug";
    }

    /**
     * Creates the url to a twitter page.
     *
     * @param $slug
     * @return string
     */
    public static function twitter($slug) {
        return "http://twitter.com/$slug";
    }

    /**
     * Creates the url to a instagram page.
     *
     * @param $slug
     * @return string
     */
    public static function instagram($slug) {
        return "http://instagram.com/$slug";
    }

    /**
     * Creates the url to a github page.
     *
     * @param $slug
     * @return string
     */
    public static function github($slug) {
        return "http://github.com/$slug";
    }

    /**
     * Creates the url to a linkedin page.
     *
     * @param $slug
     * @return string
     */
    public static function linkedin($slug) {
        return "http://linkedin.com/$slug";
    }

    /**
     * Creates the url to a audiojungle page.
     *
     * @param $slug
     * @return string
     */
    public static function audiojungle($slug) {
        return "http://audiojungle.net/item/$slug?ref=PhoenixMusic";
    }

    /**
     * Creates the url to a stye page.
     *
     * @param $slug
     * @return string
     */
    public static function stye($slug) {
        return "http://www.stye.sourceaudio.com/#!details?id=$slug";
    }

    /**
     * Creates the url to a cdbaby page.
     *
     * @param $slug
     * @return string
     */
    public static function cdbaby($slug) {
        return "http://www.cdbaby.com/cd/$slug";
    }

    /**
     * Creates the url to a amazon page.
     *
     * @param $slug
     * @return string
     */
    public static function amazon($slug) {
        return "https://www.amazon.de/gp/product/$slug";
    }

    /**
     * Creates the url to a iTunes page.
     *
     * @param $slug
     * @return string
     */
    public static function iTunes($slug) {
        return "https://itunes.apple.com/us/artist/$slug";
    }

    /**
     * Creates the url to a youtube page.
     *
     * @param $slug
     * @return string
     */
    public static function youtube($slug) {
        return "https://youtube.com/users/$slug";
    }

}
<?php
if (!function_exists('lang_url'))
{
    function lang_url($url = null) {

        $locale = service('request')->getLocale();
        return base_url($locale . "/" . $url) ;
    }
}

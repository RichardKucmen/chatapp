<?php

class Url{
    public static function moveClient($path){
            if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off"){
                $url_protocol = "https";
            } else{
                $url_protocol = "http";
            }
            header("location: $url_protocol://". $_SERVER["HTTP_HOST"] ."$path");
    }
}
<?php
namespace Header {
    /* 
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    function IncludeOnceFromRoot($fileWithoutLeadingSlash) {
       $path = $_SERVER['DOCUMENT_ROOT'];
       $path .= "/" . $fileWithoutLeadingSlash;
       include_once($path);
    }
    function IncludeFromRoot($fileWithoutLeadingSlash) {
       $path = $_SERVER['DOCUMENT_ROOT'];
       $path .= "/" . $fileWithoutLeadingSlash;
       include($path);
    }

    function RequireFromRoot($fileWithoutLeadingSlash) {
       $path = $_SERVER['DOCUMENT_ROOT'];
       $path .= "/" . $fileWithoutLeadingSlash;
       require($path);
    }
    function RequireOnceFromRoot($fileWithoutLeadingSlash) {
       $path = $_SERVER['DOCUMENT_ROOT'];
       $path .= "/" . $fileWithoutLeadingSlash;
       require_once($path);
    }

}
<?php

const DB_HOST = "localhost";
const DB_USER = "cpcelr_adm";
const DB_PASS = "bdcpceLR2015";
const DB_NAME = "documentos";

const APP_NAME = "sgd";
const THEME_PATH = "/sgd/static/theme";
const FILES_PATH = "/home/cpcelr/private/";
const DEFAULT_MODULE = "archivos";
const DEFAULT_ACTION = "ingresar";

const ALG_USER = "crc32";
const ALG_PASS = "sha512";
const ALG_TOKEN = "md5";

const SO_UNIX = false;
const TEMPLATE = "static/template.html";

define('MB', 1048576);
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
ini_set('include_path', DOCUMENT_ROOT);
date_default_timezone_set("America/Argentina/Buenos_Aires");

session_start();
if(!isset($_SESSION[md5(APP_NAME)])) $_SESSION[md5(APP_NAME)] = false;
?>
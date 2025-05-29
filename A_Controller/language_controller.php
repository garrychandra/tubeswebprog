<?php
// Handle language selection and cookie setting
if (isset($_GET['lang'])) {
    $lang_code = $_GET['lang'];
    setcookie('lang', $lang_code, time() + 86400 * 30, '/');
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

// Default language code or from cookie
$lang_code = $_COOKIE['lang'] ?? 'en';

// Path to XML language file
$xml_path = __DIR__ . "/lang/{$lang_code}.xml";

// Load XML if exists, otherwise fallback to en.xml or empty object
if (file_exists($xml_path)) {
    $lang_data = simplexml_load_file($xml_path);
    
} else {
    $lang_data = simplexml_load_file(__DIR__ . "/assets/en.xml");
}

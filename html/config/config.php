<?php
$str = $_SERVER['SERVER_SOFTWARE'];
$start = strpos ($str, '(');
$end = strpos ($str, ')', $start + 1);
$length = $end - $start;
$result = substr ($str, $start + 1, $length - 1); 
return (object) array(
    /* XAMPP */
    'bdhost' => 'localhost',
    'bduser' => 'root',
    'bdpass' => '',
    /* CENTOS + MARIADB 
    'bdhost' => '192.168.88.112',
    'bduser' => 'root',
    'bdpass' => 'ninja1234',
    /**/
    'bdport' => '',
    'bdname' => 'NINJADATOS',
    'serverso' => $result,
    'windowswebp' => 'C:\\xampp\\htdocs\\ninjastore\\html\\static\\libwebp-windows\\bin\\',
    'windowsimagenes' => 'C:\\xampp\\htdocs\\ninjastore\\html\\imagenes\\',
    'modotest' => true,
    'comisiones' => '5',
    'comisionesvip' => '3',
    'iva' => '22',
    'app_info' => array(
        'appName'=>"Ninja Store",
        'appURL'=> "https://www.nijastore.uy/"
    ),
    'ipserver' => '192.168.1.25',
    'dnsserver' => 'https://www.ninjastore.uy',
    'staticsrv' => '../imagenes',
    'mailHost' => 'smtp.gmail.com',
    'mailSMTPAuth' => 'true',
    'mailUsername' => 'emgabo@gmail.com',
    'mailPassword' => 'Insercom02',
    'mailSMTPSecure' => 'ssl',
    'mailPort' => '465'
);
?>
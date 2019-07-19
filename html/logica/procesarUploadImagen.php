<?php 
session_start();
$config = include('../config/config.php');
require_once('../clases/thumbnail.class.php');
if (empty($_FILES['imagen'])) {
    print_r("OLVIDATEEEEEEEEEEEEEEEEEEEEEee");
} 
function reArrayFiles(&$file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);
    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
}
unset($_SESSION['IMAGEN']);
$server = empty($_POST['server']) ? '' : $_POST['server'];
$user = empty($_POST['user']) ? '' : $_POST['user'];
$success = null;
$paths;
$file_ary = reArrayFiles($_FILES['imagen']);
foreach ($file_ary as $file) {
    $ext = explode('.',$file['name']);
    $imgname=md5(uniqid());
    $target = "../imagenes/" . $imgname . "." . $ext[count($ext)-1];
    $targettn = "../imagenes/" . $imgname . "_tn." . $ext[count($ext)-1];
    $targetdi = "../imagenes/" . $imgname . "_di." . $ext[count($ext)-1];
    $webp = "../imagenes/" . $imgname . ".webp";
    $webptn = "../imagenes/" . $imgname . "_tn.webp";
    $webpdi = "../imagenes/" . $imgname . "_di.webp";
    try {
        copy($file['tmp_name'], $targettn);
        copy($file['tmp_name'], $targetdi);
        require_once('../logica/procesarRecorteImagen.php');
        /*var_dump($target);
        var_dump($targettn);
        var_dump($targetdi);*/

        $magicianObj = new imageLib($targettn);
        $magicianObj -> resizeImage(250, 250, 'crop');
        $magicianObj -> saveImage($targettn);

        $magicianObj = new imageLib($targetdi);
        $magicianObj -> resizeImage(640, 360, 'crop');
        $magicianObj -> saveImage($targetdi);

        move_uploaded_file($file['tmp_name'] , $target);
        /* ------------------------------------------------ */
        /* Verificar si el server es linux o windows */
        /* ------------------------------------------------ */
        $sistema=$config->serverso;
        if ($sistema=="CentOS") {
            if ($file['type']=="image/gif") {
                //Imagen en GIF usa otro binario
                exec("gif2webp -q 80 " . $target . " -o " . $webp); // Tamaño original
            }else{
                exec("cwebp -q 80 " . $target . " -o " . $webp); // Tamaño original
                exec("cwebp -q 80 " . $targettn . " -o " . $webptn); // Tamaño 250*250
                exec("cwebp -q 80 " . $targetdi . " -o " . $webpdi); // Tamaño 640*360
            }
        }else{
            if ($file['type']=="image/gif") {
                /* Imagen en GIF usa otro binario*/
                exec($config->windowswebp . "gif2webp.exe -q 80 " . $config->windowsimagenes . $target . " -o " . $webp); // Tamaño original
            }else{
                exec($config->windowswebp . "cwebp.exe -q 80 " . $config->windowsimagenes . $target . " -o " . $webp); // Tamaño original
                exec($config->windowswebp . "cwebp.exe -q 80 " . $config->windowsimagenes . $targettn . " -o " . $webptn); // Tamaño 250*250
                exec($config->windowswebp . "cwebp.exe -q 80 " . $config->windowsimagenes . $targetdi . " -o " . $webpdi); // Tamaño 640*360
            }
        }
        /* ------------------------------------------------ */
        $_SESSION['IMAGEN'][]=$imgname;
        if ($file['type']=="image/png") {
            $image = imagecreatefrompng($target);
            $quality = 100;
            $outputFile = "../imagenes/" . $imgname . ".jpg";
            imagejpeg($image, $outputFile, $quality);
            imagedestroy($image);
            $image = imagecreatefrompng($targettn);
            $quality = 100;
            $outputFile = "../imagenes/" . $imgname . "_tn.jpg";
            imagejpeg($image, $outputFile, $quality);
            imagedestroy($image);
            $image = imagecreatefrompng($targetdi);
            $quality = 100;
            $outputFile = "../imagenes/" . $imgname . "_di.jpg";
            imagejpeg($image, $outputFile, $quality);
            imagedestroy($image);
            unlink($target); //elimina imagen
            unlink($targettn); //elimina imagen
            unlink($targetdi); //elimina imagen
        }
        $success = true;
    } catch (PDOException $e) {
        print "Error: ".$e->getMessage();
        $success = false;
        exit();
    }
}
if ($success === true) {
    $output['done']= 'Sin Problema';
} elseif ($success === false) {
    $output['error'] = 'Error mientras subia la imagen. Contacta un administrador';
    foreach ($paths as $file) {
        unlink($file);
    }
} else {
    $output['error']= 'Ninguna imagen fue procesada.';
}
echo json_encode($output);
?>
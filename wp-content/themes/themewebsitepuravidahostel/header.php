<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<?php orange_head(); ?>
<body <?php body_class(''); ?>>
<?php echo orange_side_button(); ?>
<div id="container">
<?php
    orange_require_php_archive([ 'archive' => 'navbar.php' ]);
    echo orange_header([ 'type' => 'bloginfo' ]);
?>
<?php
require 'vendor/autoload.php';
// require_once("../autoload.php");
require 'contants.php';
 use ModernPHPException\ModernPHPException;
  $exc = new ModernPHPException();
 $exc->start();

(new App);

// echo ASSETS;
<?php
include realpath("../vendor/Autoload.php");

$loader = new \Twig\Loader\FilesystemLoader('../twigtemplates');



$twig = new \Twig\Environment($loader);

echo $twig->render('index.twig', ['name' => 'Admin']);
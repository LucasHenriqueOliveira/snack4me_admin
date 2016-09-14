<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = [
	__DIR__ . "/Entities"
]; 
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver' => 'pdo_mysql',
    'host'     => 'www.anjtransportes.com.br',
    'user'     => 'anjtr452',
    'password' => 'u4Bvh85Y7p',
    'dbname'   => 'anjtr452_snack4me_hotel',
    'charset' => 'utf8',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

function getEntityManager(){
	global $entityManager;
	return $entityManager;
}

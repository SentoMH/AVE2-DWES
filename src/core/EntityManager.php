<?php

namespace AP\Core;

use Doctrine\ORM\ORMSetup;

class EntityManager
{
    private $entityManager;

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager(): \Doctrine\ORM\EntityManager
    {
        return $this->entityManager;
    }

    public function __construct()
    {
        //Guardamos la ruta donde están ubicados todas las entidades.
        $paths = array(__DIR__ . '/../' . $_ENV['ENTITYFOLDER']);
        //Indicamos que estamos en modo desarrollo. Cogemos el valor de la configuración
        $isDevMode = boolval($_ENV["DEVELOP_MODE"]);
        //Cargamos en un array los datos de la conexión desde el archivo .env
        $dbParams = array(
            'host' => $_ENV["DBSERVER"],
            'driver' => $_ENV["DBDRIVER"],
            'user' => $_ENV["BDUSER"],
            'password' => $_ENV["DBPASSWORD"],
            'dbname' => $_ENV["DBNAME"],
        );

        //Creamos la configuración de donde y como
        $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode, null, null);
        //Creamos el objeto EntityManager con la configuración que hemos definido
        // para poder instanciarlo en esta clase.
        $this->entityManager = \Doctrine\ORM\EntityManager::create($dbParams, $config);
        //$this->entityManager = new \Doctrine\ORM\EntityManager($dbParams,$config);
    }
}

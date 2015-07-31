<?php
use Propel\Runtime\Propel;
use Propel\Runtime\Connection\ConnectionManagerSingle;
$serviceContainer = Propel::getServiceContainer();
$serviceContainer->setAdapterClass('metadocument', 'mysql');
$manager = new ConnectionManagerSingle();
$manager->setConfiguration(array (
  'dsn'      => 'mysql:host=localhost;dbname=metadocu_dbdocument',
  'user'     => 'developer',
  'password' => 'developer',
));
$serviceContainer->setConnectionManager('metadocument', $manager);
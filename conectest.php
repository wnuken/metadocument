<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';
use Propel\Runtime\Propel;
use Propel\Runtime\Connection\ConnectionManagerSingle;
$serviceContainer = Propel::getServiceContainer();
$serviceContainer->setAdapterClass('metadocument', 'mysql');
$manager = new ConnectionManagerSingle();
$manager->setConfiguration(array (
  'dsn'      => 'mysql:host=localhost;dbname=metadocument',
  'user'     => 'developer',
  'password' => 'developer',
));
$serviceContainer->setConnectionManager('metadocument', $manager);

var_dump($serviceContainer);
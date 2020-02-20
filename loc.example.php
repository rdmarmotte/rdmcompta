<?php
use ITRocks\Framework\Configuration;
use ITRocks\Framework\Configuration\Environment;
use ITRocks\Framework\Dao\File;
use ITRocks\Framework\Dao\Mysql;

$loc = [
	Configuration::ENVIRONMENT => Environment::DEVELOPMENT,
	File\Link::class => ['class' => File\Link::class, 'path' => '/path/to/your/app/files'],
	Mysql\Link::class => [
		Mysql\Link::DATABASE => 'rdmarmotte_rdmcompta',
		Mysql\Link::LOGIN    => 'rdmarmotte_rdmcompta'
	]
];

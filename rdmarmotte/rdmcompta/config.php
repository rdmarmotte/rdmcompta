<?php
namespace RDMarmotte\RdmCompta;

use ITRocks\Framework;
use ITRocks\Framework\Configuration;
use ITRocks\Framework\Dao\File;
use ITRocks\Framework\Locale;
use ITRocks\Framework\Locale\Number_Format;
use ITRocks\Framework\Plugin\Priority;

global $loc;
require __DIR__ . '/../../loc.php';
require __DIR__ . '/../../itrocks/framework/config.php';

$config['RDMarmotte/RdmCompta'] = [
	Configuration::APP         => Application::class,
	Configuration::ENVIRONMENT => $loc[Configuration::ENVIRONMENT],
	Configuration::EXTENDS_APP => 'ITRocks/Framework',

	Priority::CORE => [
		Framework\Builder::class => include(__DIR__ . '/builder.php'),
		Framework\Error_Handler\Error_Handlers::class => [
			[
				E_ALL & ~E_COMPILE_WARNING & ~E_CORE_WARNING & ~E_DEPRECATED & ~E_NOTICE & ~E_STRICT
				& ~E_USER_DEPRECATED & ~E_USER_NOTICE & ~E_USER_WARNING & ~E_WARNING,
				Framework\Error_Handler\To_Exception_Error_Handler::class
			],
			[
				E_COMPILE_WARNING | E_CORE_WARNING | E_DEPRECATED | E_NOTICE | E_STRICT
				| E_USER_DEPRECATED | E_USER_NOTICE | E_USER_WARNING | E_WARNING,
				Framework\Error_Handler\Report_Call_Stack_Error_Handler::class
			]
		]
	],

	//----------------------------------------------------------------------- LOWEST priority plugins
	Priority::LOWEST => [
		Framework\User\Access_Control::class,
		Framework\User\Access_Control\Data::class
	],

	//------------------------------------------------------------------------ LOWER priority plugins
	Priority::LOWER => [
		// lower than Maintainer to log all sql errors
		Framework\Dao\Mysql\File_Logger::class => [
			'path' => $loc[File\Link::class]['path'] . '/logs',
		]
	],

	Priority::NORMAL => [
		Framework\Component\Menu::class => include(__DIR__ . '/menu.php'),
		Framework\Dao::class => [
			Framework\Dao::LINKS_LIST => [
				'files' => $loc[File\Link::class]
			],
		],
		Framework\Feature\Validate\Validator::class,
		Framework\Locale::class => [
			Locale::DATE     => 'd/m/Y',
			Locale::LANGUAGE => 'fr',
			Locale::NUMBER   => [
				Number_Format::DECIMAL_MINIMAL_COUNT => 2,
				Number_Format::DECIMAL_MAXIMAL_COUNT => 2,
				Number_Format::DECIMAL_SEPARATOR     => ',',
				Number_Format::THOUSAND_SEPARATOR    => ' '
			]
		],
		Framework\Locale\Translation\Hub_Client::class,
		Framework\Logger::class,
		Framework\RAD\Feature\Maintainer::class,
		Framework\Tools\Feature_Class\Update::class,
		Framework\User\Group\Admin_Plugin::class
	],

	Priority::HIGHER => [
		Framework\Dao\Cache::class,
		Framework\View\Logger::class => [
			'path' => $loc[Framework\Dao\File\Link::class]['path'] . '/logs'
		]
	]

];

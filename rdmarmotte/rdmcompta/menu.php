<?php
namespace RDMarmotte\RdmCompta;

use ITRocks\Framework\Component\Menu;

return [
	Menu::TITLE => [SL, 'Home', '#main'],
	'Administration' => [
		'/ITRocks/Framework/Users' => 'Users',
		'/ITRocks/Framework/User/Groups' => 'User groups',
		'/ITRocks/Framework/RAD/Features' => 'Features',
		'/ITRocks/Framework/Logger/Entries' => 'Logs'
	]
];

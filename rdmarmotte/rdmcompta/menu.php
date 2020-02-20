<?php
namespace RDMarmotte\RdmCompta;

use ITRocks\Framework\Component\Menu;

return [
	Menu::TITLE => [SL, 'Home', '#main'],
	'Paramétrage' => [
		'/RDMarmotte/RdmCompta/Operations' => 'Opérations',
		'/RDMarmotte/RdmCompta/Comptes' => 'Comptes',
		'/RDMarmotte/RdmCompta/Operation/Types' => 'Types'
	],
	'Administration' => [
		'/ITRocks/Framework/Users' => 'Users',
		'/ITRocks/Framework/User/Groups' => 'User groups',
		'/ITRocks/Framework/RAD/Features' => 'Features',
		'/ITRocks/Framework/Logger/Entries' => 'Logs'
	]
];

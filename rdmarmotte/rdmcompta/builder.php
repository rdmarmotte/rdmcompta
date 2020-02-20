<?php
namespace RDMarmotte\RdmCompta;

use ITRocks\Framework;
use RDMarmotte\RdmCompta;

return [
	Framework\User::class => [
		Framework\User\Group\Has_Groups::class,
		RdmCompta\User\Photo::class
	]
];

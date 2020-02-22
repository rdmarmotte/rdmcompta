<?php
namespace RDMarmotte\RdmCompta\Compte;

use ITRocks\Framework\Dao\Func;
use ITRocks\Framework\Dao\Option;
use ITRocks\Framework\User;
use ITRocks\Framework\Webservice\Json;

/**
 * Contrôleur JSON pour les comptes (API par défaut / popup de contrôles de saisie combo)
 */
class Json_Controller extends Json\Controller
{

	//---------------------------------------------------------------------------------------- search
	/**
	 * @param $what       object|array source object for filter, only set properties will be used for
	 *                    search
	 * @param $class_name string must be set if is $what is a filter array instead of a filter object
	 * @param $options    Option[] some options for advanced search
	 * @return object[] a collection of read objects
	 */
	protected function search($what, $class_name, array $options)
	{
		$what = $what
			? Func::andOp(['titulaires' => User::current(), $what])
			: ['titulaires' => User::current()];
		return parent::search($what, $class_name, $options);
	}

}

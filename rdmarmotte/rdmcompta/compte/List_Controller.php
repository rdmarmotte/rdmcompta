<?php
namespace RDMarmotte\RdmCompta\Compte;

use ITRocks\Framework\Dao\Func;
use ITRocks\Framework\Dao\Option;
use ITRocks\Framework\Feature\List_;
use ITRocks\Framework\Tools\List_Data;
use ITRocks\Framework\User;

/**
 * Contrôleur pour la liste des comptes
 */
class List_Controller extends List_\Controller
{

	//-------------------------------------------------------------------------------- readDataSelect
	/**
	 * Restreint les données avec l'utilisateur connecté
	 *
	 * @param $class_name      string Class name for the read object
	 * @param $properties_path string[] the list of the columns names : only those properties
	 *                         will be read. There are 'column.sub_column' to get values from linked
	 *                         objects from the same data source
	 * @param $search          object|array source object for filter, set properties will be used for
	 *                         search. Can be an array associating properties names to matching
	 *                         search value too.
	 * @param $options         Option[] some options for advanced search
	 * @return List_Data A list of read records. Each record values (may be objects) are
	 *         stored in the same order than columns.
	 */
	public function readDataSelect($class_name, array $properties_path, $search, array $options)
	{
		$search = $search
			? Func::andOp(['titulaires' => User::current(), $search])
			: ['titulaires' => User::current()];
		return parent::readDataSelect($class_name, $properties_path, $search, $options);
	}

}

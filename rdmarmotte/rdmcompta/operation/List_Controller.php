<?php
namespace RDMarmotte\RdmCompta\Operation;

use ITRocks\Framework\Controller\Parameters;
use ITRocks\Framework\Dao\Func;
use ITRocks\Framework\Dao\Option;
use ITRocks\Framework\Feature\List_;
use ITRocks\Framework\Session;
use ITRocks\Framework\Tools\List_Data;
use RDMarmotte\RdmCompta\Compte;

/**
 * Contrôleur de liste d'opérations
 */
class List_Controller extends List_\Controller
{

	//-------------------------------------------------------------------------------- readDataSelect
	/**
	 * Restreint les données avec le compte sélectionné
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
		if ($compte = Session::current()->get(Compte::class)) {
			$search = $search ? Func::andOp(['compte' => $compte, $search]) : ['compte' => $compte];
		}
		return parent::readDataSelect($class_name, $properties_path, $search, $options);
	}

	//------------------------------------------------------------------------------------------- run
	/**
	 * @param $parameters Parameters
	 * @param $form       array
	 * @param $files      array[]
	 * @param $class_name string
	 * @return mixed
	 */
	public function run(Parameters $parameters, array $form, array $files, $class_name)
	{
		if ($compte = $parameters->getObject(Compte::class)) {
			Session::current()->set($compte);
		}
		elseif ($parameters->has('toutes', true)) {
			Session::current()->remove(Compte::class);
		}
		return parent::run($parameters, $form, $files, $class_name);
	}

}

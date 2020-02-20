<?php
namespace RDMarmotte\RdmCompta\Operation;

use ITRocks\Framework\Controller\Parameter;
use ITRocks\Framework\Controller\Parameters;
use ITRocks\Framework\Dao;
use ITRocks\Framework\Feature\Save;
use ITRocks\Framework\View;
use RDMarmotte\RdmCompta\Operation;

/**
 * Contrôleur de sauvegarde d'une opération
 */
class Save_Controller extends Save\Controller
{

	//------------------------------------------------------------------------------------------- run
	/**
	 * @param $parameters   Parameters
	 * @param $form         array
	 * @param $files        array[]
	 * @param $class_name   string
	 * @return string
	 */
	public function run(Parameters $parameters, array $form, array $files, $class_name)
	{
		// If it is a new operation : will redirect to a new operation
		if (!Dao::getObjectIdentifier($parameters->getMainObject(Operation::class))) {
			$parameters->set(Parameter::THEN, View::link(Operation::class));
		}
		return parent::run($parameters, $form, $files, $class_name);
	}

}

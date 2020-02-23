<?php
namespace RDMarmotte\RdmCompta\Operation\Libelle;

use ITRocks\Framework\Dao;
use ITRocks\Framework\Dao\Func;
use ITRocks\Framework\Dao\Option;
use ITRocks\Framework\Dao\Option\Group_By;
use ITRocks\Framework\Dao\Option\Sort;
use ITRocks\Framework\User;
use ITRocks\Framework\Webservice\Json;
use RDMarmotte\RdmCompta\Operation;

/**
 * Contrôleur json pour la complétion automatique du libellé
 */
class Json_Controller extends Json\Controller
{

	//------------------------------------------------------------------------------------- OPERATION
	const OPERATION = Operation::class . '(compte=compte)';

	//-------------------------------------------------------------------------------- OPERATION_TYPE
	const OPERATION_TYPE = self::OPERATION . '.type';

	//---------------------------------------------------------------------------------- $filter_type
	/**
	 * @var boolean
	 */
	protected $filter_type = false;

	//-------------------------------------------------------------------------- applyFiltersToSearch
	/**
	 * @param $search  array|object
	 * @param $filters array[]|string[] list of filters to apply (most of times string[])
	 */
	protected function applyFiltersToSearch(&$search, array $filters)
	{
		foreach ($filters as $key => $value) {
			if ($key === 'type') {
				unset($filters[$key]);
				if ($value) {
					$filters[static::OPERATION_TYPE] = $value;
					$this->filter_type = true;
				}
			}
		}
		parent::applyFiltersToSearch($search, $filters);
	}

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
		if (!Group_By::in($options)) {
			$options[] = Dao::groupBy();
		}
		if ($this->filter_type) {
			if (Sort::in($options)) {
				foreach ($options as $key => $option) {
					if ($option instanceof Sort) {
						unset($options[$key]);
						break;
					}
				}
			}
			$options[] = Dao::sort('-' . static::OPERATION . '.date');
		}
		$what = $what
			? Func::andOp(['compte.titulaires' => User::current(), $what])
			: ['compte.titulaires' => User::current()];
		return parent::search($what, $class_name, $options);
	}

}

<?php
namespace RDMarmotte\RdmCompta\Operation;

/**
 * Type d'opération
 *
 * @business
 * @feature
 * @list libelle, sens
 * @representative libelle
 * @store_name type_operations
 */
class Type
{

	//-------------------------------------------------------------------------------------- $libelle
	/**
	 * @alias type
	 * @mandatory
	 * @var string
	 */
	public $libelle;

	//----------------------------------------------------------------------------------------- $sens
	/**
	 * @mandatory
	 * @values émis, reçu
	 * @var string
	 */
	public $sens = 'émis';

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return strval($this->libelle);
	}

}

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

	//--------------------------------------------------------------------------------- $sens @values
	const EMIS = 'émis';
	const RECU = 'reçu';

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
	 * @values self::const
	 * @var string
	 */
	public $sens = self::EMIS;

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return strval($this->libelle);
	}

}

<?php
namespace RDMarmotte\RdmCompta;

use ITRocks\Framework\Locale\Loc;
use ITRocks\Framework\Mapper\Component;
use ITRocks\Framework\Property\Reflection_Property;
use ITRocks\Framework\Tools\Date_Time;
use ITRocks\Framework\View\Has_Object_Class;
use RDMarmotte\RdmCompta\Operation\Libelle;
use RDMarmotte\RdmCompta\Operation\Type;

/**
 * Opération
 *
 * @business
 * @display_order compte, date, type, libelle_1, libelle_2, montant, pointage
 * @feature
 * @representative date, libelle_1, montant
 */
class Operation implements Has_Object_Class
{
	use Component;

	//--------------------------------------------------------------------------------------- $compte
	/**
	 * @composite
	 * @default Compte::courant
	 * @link Object
	 * @mandatory
	 * @var Compte
	 */
	public $compte;

	//----------------------------------------------------------------------------------------- $date
	/**
	 * @default Date_Time::today
	 * @link DateTime
	 * @mandatory
	 * @var Date_Time
	 */
	public $date;

	//------------------------------------------------------------------------------------ $libelle_1
	/**
	 * @filters compte, type
	 * @link Object
	 * @mandatory
	 * @var Libelle
	 */
	public $libelle_1;

	//------------------------------------------------------------------------------------ $libelle_2
	/**
	 * @var string
	 */
	public $libelle_2;

	//-------------------------------------------------------------------------------------- $montant
	/**
	 * @decimals 2
	 * @mandatory
	 * @unit €
	 * @unsigned
	 * @var float
	 */
	public $montant;

	//------------------------------------------------------------------------------------- $pointage
	/**
	 * @mandatory
	 * @values non, pointée, rapprochée
	 * @var string
	 */
	public $pointage = 'non';

	//----------------------------------------------------------------------------------------- $type
	/**
	 * @link Object
	 * @mandatory
	 * @var Type
	 */
	public $type;

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @noinspection PhpDocMissingThrowsInspection
	 * @return string
	 */
	public function __toString()
	{
		/** @noinspection PhpUnhandledExceptionInspection */
		return join(SP, [
			Loc::dateToLocale($this->date),
			$this->libelle_1,
			Loc::propertyToLocale(new Reflection_Property($this, 'montant'), $this->montant)
		]);
	}

	//----------------------------------------------------------------------------------- objectClass
	/**
	 * @return string
	 */
	public function objectClass()
	{
		return strUri($this->type->sens);
	}

}

<?php
namespace RDMarmotte\RdmCompta\Operation;

use ITRocks\Framework\Builder;
use ITRocks\Framework\Component\Combo\Fast_Add;
use ITRocks\Framework\Dao;
use ITRocks\Framework\Tools\Call_Stack;
use ITRocks\Framework\Traits\Is_Immutable;
use RDMarmotte\RdmCompta\Compte;
use RDMarmotte\RdmCompta\Operation;

/**
 * Libellé d'opération
 *
 * @business
 */
class Libelle implements Fast_Add
{
	use Is_Immutable;

	//--------------------------------------------------------------------------------------- $compte
	/**
	 * @link Object
	 * @var Compte
	 */
	public $compte;

	//-------------------------------------------------------------------------------------- $libelle
	/**
	 * @var string
	 */
	public $libelle;

	//----------------------------------------------------------------------------------- __construct
	/**
	 * @param $compte  Compte
	 * @param $libelle string
	 */
	public function __construct(Compte $compte = null, $libelle = null)
	{
		if ($compte)  $this->compte  = $compte;
		if ($libelle) $this->libelle = $libelle;
	}

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return strval($this->libelle);
	}

	//------------------------------------------------------------------------------------ fromString
	/**
	 * @noinspection PhpDocMissingThrowsInspection
	 * @param $string string
	 * @return static
	 */
	public static function fromString($string)
	{
		$compte  = (new Call_Stack)->getObjectArgument(Operation::class)->compte ?: Compte::courant();
		$libelle = $string;
		/** @noinspection PhpUnhandledExceptionInspection class */
		return Dao::searchOne(['compte' => $compte, 'libelle' => $libelle], Libelle::class)
			?: Builder::create(Libelle::class, [$compte, $libelle]);
	}

}

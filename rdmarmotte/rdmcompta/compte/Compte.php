<?php
namespace RDMarmotte\RdmCompta;

use ITRocks\Framework\Session;
use ITRocks\Framework\User;
use RDMarmotte\RdmCompta\Compte\Menu;

/**
 * Compte
 *
 * @after_delete Menu::refresh
 * @after_write Menu::refresh
 * @business
 * @display_order libelle, titulaires, commentaire,
 *                solde_initial, solde_courant, solde_a_venir, solde_pointe, solde_rapproche
 * @feature
 * @representative libelle
 * @see Menu
 * @sort libelle
 */
class Compte
{

	//---------------------------------------------------------------------------------- $commentaire
	/**
	 * @multiline
	 * @var string
	 */
	public $commentaire;

	//-------------------------------------------------------------------------------------- $libelle
	/**
	 * @var string
	 */
	public $libelle;

	//----------------------------------------------------------------------------------- $operations
	/**
	 * @link Collection
	 * @user invisible
	 * @var Operation[]
	 */
	public $operations;

	//-------------------------------------------------------------------------------- $solde_a_venir
	/**
	 * @null
	 * @var float
	 */
	public $solde_a_venir;

	//-------------------------------------------------------------------------------- $solde_courant
	/**
	 * @null
	 * @var float
	 */
	public $solde_courant;

	//-------------------------------------------------------------------------------- $solde_initial
	/**
	 * @null
	 * @var float
	 */
	public $solde_initial;

	//--------------------------------------------------------------------------------- $solde_pointe
	/**
	 * @null
	 * @var float
	 */
	public $solde_pointe;

	//------------------------------------------------------------------------------ $solde_rapproche
	/**
	 * @null
	 * @var float
	 */
	public $solde_rapproche;

	//----------------------------------------------------------------------------------- $titulaires
	/**
	 * @link Map
	 * @var User[]
	 */
	public $titulaires;

	//------------------------------------------------------------------------------------ __toString
	/**
	 * @return string
	 */
	public function __toString()
	{
		return strval($this->libelle);
	}

	//--------------------------------------------------------------------------------------- courant
	/**
	 * @return static
	 */
	public static function courant()
	{
		return Session::current()->get(static::class);
	}

}

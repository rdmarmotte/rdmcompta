<?php
namespace RDMarmotte\RdmCompta;

use ITRocks\Framework\Dao;
use ITRocks\Framework\Dao\Func;
use ITRocks\Framework\Session;
use ITRocks\Framework\Tools\Date_Time;
use ITRocks\Framework\User;
use RDMarmotte\RdmCompta\Compte\Menu;

/**
 * Compte
 *
 * @after_delete Menu::refresh
 * @after_write Menu::refresh
 * @business
 * @display_order libelle, titulaires, commentaire,
 *                solde_initial, solde_rapproche, solde_pointe, solde_courant, solde_a_venir
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
	 * @getter
	 * @null
	 * @user readonly
	 * @var float
	 */
	public $solde_a_venir;

	//-------------------------------------------------------------------------------- $solde_courant
	/**
	 * @getter
	 * @null
	 * @user readonly
	 * @var float
	 */
	public $solde_courant;

	//-------------------------------------------------------------------------------- $solde_initial
	/**
	 * @null
	 * @user create_only
	 * @var float
	 */
	public $solde_initial;

	//--------------------------------------------------------------------------------- $solde_pointe
	/**
	 * @getter
	 * @null
	 * @user readonly
	 * @var float
	 */
	public $solde_pointe;

	//------------------------------------------------------------------------------ $solde_rapproche
	/**
	 * @getter
	 * @null
	 * @user readonly
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

	//-------------------------------------------------------------------------------- getSoldeAVenir
	/**
	 * @noinspection PhpUnused @getter
	 * @return float
	 */
	protected function getSoldeAVenir()
	{
		return $this->solde_pointe + $this->operationsTotal(['pointage' => 'non']);
	}

	//------------------------------------------------------------------------------- getSoldeCourant
	/**
	 * @noinspection PhpUnused @getter
	 * @return float
	 */
	protected function getSoldeCourant()
	{
		return $this->solde_pointe
			+ $this->operationsTotal([
				'pointage' => 'non',
				'date'     => Func::lessOrEqual(Date_Time::now())
			]);
	}

	//-------------------------------------------------------------------------------- getSoldePointe
	/**
	 * @noinspection PhpUnused @getter
	 * @return float
	 */
	protected function getSoldePointe()
	{
		return $this->solde_rapproche + $this->operationsTotal(['pointage' => 'pointée']);
	}

	//----------------------------------------------------------------------------- getSoldeRapproche
	/**
	 * @noinspection PhpUnused @getter
	 * @return float
	 */
	protected function getSoldeRapproche()
	{
		return $this->solde_initial + $this->operationsTotal(['pointage' => 'rapprochée']);
	}

	//------------------------------------------------------------------------------- operationsTotal
	/**
	 * @param $filtre array
	 * @return float
	 */
	public function operationsTotal(array $filtre = [])
	{
		$total = 0;
		$filtre['compte']    = $this;
		$filtre['type.sens'] = 'émis';
		Dao::select(
			Operation::class,
			['montant' => Func::sum()],
			$filtre,
			function(Operation $operation) use(&$total) { $total -= $operation->montant; }
		);
		$filtre['type.sens'] = 'reçu';
		Dao::select(
			Operation::class,
			['montant' => Func::sum()],
			$filtre,
			function(Operation $operation) use(&$total) { $total += $operation->montant; }
		);
		return $total;
	}

}

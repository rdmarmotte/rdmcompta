<?php
namespace RDMarmotte\RdmCompta\Compte;

use ITRocks\Framework\Builder;
use ITRocks\Framework\Component;
use ITRocks\Framework\Component\Menu\Block;
use ITRocks\Framework\Component\Menu\Item;
use ITRocks\Framework\Controller\Feature;
use ITRocks\Framework\Dao;
use ITRocks\Framework\View;
use RDMarmotte\RdmCompta\Compte;
use RDMarmotte\RdmCompta\Operation;

/**
 * Le menu contient la liste des comptes
 */
abstract class Menu
{

	//------------------------------------------------------------------------------------------ bloc
	/**
	 * Fabrique le bloc de menu 'Comptes'
	 *
	 * @noinspection PhpDocMissingThrowsInspection
	 * @return Block
	 */
	public static function bloc()
	{
		/** @noinspection PhpUnhandledExceptionInspection class */
		$block = Builder::create(Block::class);
		$block->title = 'Comptes';
		$block->items = [];
		foreach (Dao::readAll(Compte::class, Dao::sort()) as $compte) {
			/** @noinspection PhpUnhandledExceptionInspection class */
			$item = Builder::create(Item::class);
			$item->caption  = $compte->libelle;
			$item->class    = strSimplify($compte->libelle, false, '-');
			$item->link     = View::link(Operation::class, Feature::F_LIST, $compte);
			$block->items[] = $item;
		}
		return $block;
	}

	//--------------------------------------------------------------------------------------- refresh
	/**
	 * Rafraîchissement du menu
	 */
	public static function refresh()
	{
		Component\Menu::get()->refresh();
	}

}

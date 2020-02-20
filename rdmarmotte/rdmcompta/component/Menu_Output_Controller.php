<?php
namespace RDMarmotte\RdmCompta\Component;

use ITRocks\Framework\Component\Menu;
use ITRocks\Framework\Component\Menu\Output_Controller;
use ITRocks\Framework\Controller\Parameters;
use RDMarmotte\RdmCompta\Compte;

/**
 * Menu component output controller
 */
class Menu_Output_Controller extends Output_Controller
{

	//------------------------------------------------------------------------------------------- run
	/**
	 * @param $parameters Parameters
	 * @param $form       array
	 * @param $files      array[]
	 * @return mixed
	 */
	public function run(Parameters $parameters, array $form, array $files)
	{
		$menu = $parameters->getMainObject(Menu::class);
		if (!$menu->blocks) {
			$menu = Menu::get();
			$parameters->set(Menu::class, $menu);
		}
		array_unshift($menu->blocks, Compte\Menu::bloc());
		return parent::run($parameters, $form, $files);
	}

}

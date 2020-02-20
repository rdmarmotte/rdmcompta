<?php
namespace RDMarmotte\RdmCompta\User;

use ITRocks\Framework\Dao\File;
use ITRocks\Framework\User;

/**
 * Photographie de l'utilisateur
 *
 * @extends User
 * @see User
 */
trait Photo
{

	//---------------------------------------------------------------------------------------- $photo
	/**
	 * @link Object
	 * @var File
	 */
	public $photo;

}

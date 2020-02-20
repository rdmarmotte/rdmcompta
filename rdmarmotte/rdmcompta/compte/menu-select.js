$(document).ready(function()
{
	var $body = $('body');

	//--------------------------------------------------------------------- #menu #comptes li a click
	/**
	 * Sélectionne les items de menu dès le clic, pour bien différentier le compte sélectionné
	 */
	$body.build('click', '#menu #comptes li a', function()
	{
		var $li = $(this).closest('li');
		$li.addClass('selected').siblings().removeClass('selected').removeData('clicked');
		$li.data('clicked', true);
	});

	//---------------------------------------------------------------------- #menu #comptes li select
	/**
	 * Quand itrocks.modules.js sélectionne un item de menu, passe outre cette sélection en gardant
	 * celui qui s'est fait sélectionner au moment du clic
	 */
	$body.build('select', '#menu #comptes li', function()
	{
		var $li = $(this);
		if (!$li.data('clicked')) {
			$li.removeClass('selected').siblings().each(function() {
				var $this = $(this);
				if ($this.data('clicked')) {
					$this.addClass('selected');
				}
			});
		}
	});

});

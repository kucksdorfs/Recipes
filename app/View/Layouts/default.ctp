<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
<?php echo $this->Html->charset(); ?>
<title><?php echo $cakeDescription ?>: <?php echo $title_for_layout; ?>
</title>
<?php
echo $this->Html->meta('icon');

echo $this->Html->css('cake.generic');

echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');

echo $this->Html->script('jquery-2.0.3.min');
echo $this->Html->script('jquery-ui.min');
echo $this->Html->script('knockout-2.2.1');
echo $this->Html->script('knockout-sortable.min');
?>
<script type="text/javascript">
var webRoot = "http://<?php echo $_SERVER['HTTP_HOST'] . $this->webroot ;?>";
$(document).ready(function() {
	var inputNumber = $("input[type=text].number");
	inputNumber.bind("keypress", function(arg) {
		if (arg.which == 8 || arg.which == 0) // the delete charater;
			return true;
		var key = String.fromCharCode(arg.charCode ? arg.charCode : arg.keyCode);
		var validOnce = $(this).hasClass("noDecimal") ? "" : ".";
		var valid = "0123456789" + validOnce;

		if (valid.indexOf(key) == -1)
			return false;

		var text = this.value;
		for (var i = 0 ; i < validOnce.length; i++)
		{
			var charAti = validOnce.charAt(i);
			if (text.indexOf(charAti) != -1 && key == charAti)
				return false;
		}		
	});
});
</script>
<?php 
//Get the on page spacific javascript
echo $this->fetch('pageSpecific');
?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>
				<?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?>
			</h1>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
			);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>

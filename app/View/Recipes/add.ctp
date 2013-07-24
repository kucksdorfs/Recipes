<?php 
$this->start('pageSpecific');
echo $this->Html->script('AddEdit');
?>
<script type="text/javascript">
//Add Page
var ingredients, directions;
$(document).ready(function() {
    try
    {
        ingredients = new IngredientsViewModel(document.getElementById('txtInsertXIngredients'));
        directions = new DirectionViewModel(document.getElementById('txtInsertXDirections'));
        ko.applyBindings(ingredients, document.getElementById('Ingredients'));
        ko.applyBindings(directions, document.getElementById('Directions'));
    }
    catch(ex)
    {
        alert(ex.message);
    }
});
</script>
<?php 
$this->end();
?>

<div class="recipes form">
	<?php
	echo $this->Form->create('Recipe');
	echo $this->element('EditRecipes');
	echo $this->element('EditIngredients');
	echo $this->element('EditDirections');
	echo $this->Form->end(__('Submit'));
	?>
</div>
<?php 
echo $this->element('Sidebar');
?>

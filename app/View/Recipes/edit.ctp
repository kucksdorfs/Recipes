<?php 
$this->start('pageSpecific');
echo $this->Html->script('AddEdit');
?>
<script type="text/javascript">
// Edit Page
var ingredients, directions;
$(document).ready(function() {
    try
    {
        var previousDirections = [<?php 
                                  	$directions = $this->request->data['Direction'];
                                  	for ($i = 0; $i < count($directions); $i++) {
										echo '{"Direction" : "' . $directions[$i]['direction'] . '","ID" : '. $directions[$i]['id'] . '}' . ($i == count($directions) - 1 ? "" : ",");
									}
									?>];
		var previousIngredients = [<?php
									$ingredients = $this->request->data['Ingredient'];
									for ($i = 0; $i < count($ingredients); $i++) {
										echo '{"Ingredient" : "' . $ingredients[$i]['ingredient'] . '", "Amount" : "' . $ingredients[$i]['amount'] . '", "Optional" : ' . ($ingredients[$i]['optional'] ? "true" : "false") . ', "ID" : ' . $ingredients[$i]['id'] . '}' . ($i == count($ingredients) - 1 ? "" : ",");
									}
									?>];
        ingredients = new IngredientsViewModel(document.getElementById('txtInsertXIngredients'), previousIngredients);
        directions = new DirectionViewModel(document.getElementById('txtInsertXDirections'), previousDirections);
        ko.applyBindings(ingredients, document.getElementById('Ingredients'));
        ko.applyBindings(directions, document.getElementById('Directions'));
    }
    catch(ex)
    {
        console.log(ex.message);
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

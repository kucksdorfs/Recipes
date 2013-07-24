<fieldset id="Ingredients">
	<legend><?php echo __('The Ingredients'); ?></legend>
	<input type="text" class="number noDecimal" id="txtInsertXIngredients" />
	<input type="button" data-bind="click: addIngredient"
		value="Add Ingredient" />
	<table>
		<thead>
			<tr>
				<td>Remove</td>
				<td>Ingredient</td>
				<td>Amount</td>
				<td>Optional</td>
			</tr>
		</thead>
		<tbody
			data-bind="sortable : {connectClass: 'ko_containerIngredients', data: ingredients, afterMove: afterMove}">
			<tr>
				<td>
					<input type="hidden" data-bind="value: uniqueID, attr:{id: IngredientID_ID, name: IngredientName_ID}"></input>
					<input type="hidden" data-bind="value: order, attr: { id: IngredientID_Order, name: IngredientName_Order}"></input>
					<a href="#" data-bind="click: $root.removeIngredient, visible: ShowRemove">Remove</a>
				</td>
				<td>
					<div class="input text required">
						<input type="text" required spellcheck="true" data-bind="value: ingredient, attr: { id: IngredientID_Ingredient, name: IngredientName_Ingredient}" />
					</div>
				</td>
				<td>
					<div class="input text required">
						<input type="text" required spellcheck="true" data-bind="value: amount, attr: { id: IngredientID_Amount, name: IngredientName_Amount}" />
					</div>
				</td>
				<td><input type="checkbox" data-bind="checked: optional, attr: { id: IngredientID_Optional, name: IngredientName_Optional}" />
				</td>
			</tr>
		</tbody>
	</table>
</fieldset>
<fieldset id="Directions">
	<legend>
		<?php echo __('The Directions'); ?>
	</legend>
	<input type="text" class="number noDecimal" id="txtInsertXDirections" />
	<input type="button" data-bind="click: addDirection"
		value="Add Direction" />
	<table>
		<thead>
			<tr>
				<td>Order</td>
				<td>Direction</td>
				<td>Remove</td>
			</tr>
		</thead>
		<tbody data-bind="sortable : {connectClass: 'ko_containerDirections', data: directions, afterMove: afterMove}">
			<tr>
				<td>
					<span data-bind="text: DisplayOrder"></span>
					<input type="hidden" data-bind="value: order, attr: { id: DirectionID_Order, name: DirectionName_Order}"></input>
					<input type="hidden" data-bind="value: uniqueID, attr: {id: DirectionsID_ID, name: DirectionsName_ID}"></input>
				</td>
				<td>
					<div class="input text required">
						<input type="text" required data-bind="value: direction, attr: {id: DirectionID_Direction, name: DirectionName_Direction}" spellcheck="true" />
					</div>
				</td>
				<td>
					<a href="#" data-bind="click: $root.removeDirection, visible: ShowRemove">Remove</a>
				</td>
			</tr>
		</tbody>
	</table>
</fieldset>

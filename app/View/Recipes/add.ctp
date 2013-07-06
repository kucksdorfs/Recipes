<?php 
$this->start('pageSpecific');
?>
<script type="text/javascript">
function Ingredient(order, ingredient, amount, optional) {
    var self = this;
    self.order = ko.observable(order);
    self.ingredient = ko.observable(ingredient);
    self.amount = ko.observable(amount);
    self.optional = ko.observable(optional);

	self.IngredientOrderName = ko.computed(function() {
	    return GetNamePrefix(self.order) + "[order]";
	});

	self.IngredientName = ko.computed(function() {
	    return GetNamePrefix(self.order) + "[ingredient]";
	});

	self.IngredientAmountName = ko.computed(function() {
	    return GetNamePrefix(self.order) + "[amount]";
	});
	
	self.IngredientOptionalName = ko.computed(function() {
	    return GetNamePrefix(self.order) + "[optional]";
	});

    function GetNamePrefix(id) {
        return "data[Ingredient][" + id().toString() + "]";
    }

	self.IngredientOrderID = ko.computed(function() {
	    return GetIDPrefix(self.order) + "Order";
	});

	self.IngredientID = ko.computed(function() {
	    return GetIDPrefix(self.order) + "Ingredient";
	});

	self.IngredientAmountID = ko.computed(function() {
	    return GetIDPrefix(self.order) + "Amount";
	});
	
	self.IngredientOptionalID = ko.computed(function() {
	    return GetIDPrefix(self.order) + "Optional";
	});
	
    function GetIDPrefix(id) {
        return "ingredient" + id().toString();
    }
}

function Direction(direction, order) {
    var self = this;
    self.direction = ko.observable(direction);
    self.order = ko.observable(order);
    
    self.DisplayOrder = ko.computed(function() {
        return self.order() + 1;
    });
    
    self.DirectionName = ko.computed(function() {
        return GetNamePrefix(self.order) + "[direction]";
    });
    
    self.DirectionOrderName = ko.computed(function() {
        return GetNamePrefix(self.order) + "[order]";
    });

    function GetNamePrefix(id) {
        return "data[Direction][" + id().toString() + "]";
    }
    
    self.DirectionID = ko.computed(function() {
        return GetIDPrefix(self.order) + "Direction";
    });
    
    self.DirectionOrderID = ko.computed(function() {
        return GetIDPrefix(self.order) + "Order";
    });

    function GetIDPrefix(id) {
        return "direction" + id().toString();
    }
}

function IngredientsViewModel() {
    var self = this;
    self.ingredients = ko.observableArray();

    self.addIngredient = function() {
        self.ingredients.push(new Ingredient(self.ingredients().length, "", "", false));
    }
    self.removeIngredient = function(ingredient) {
        self.ingredients.remove(ingredient);
        AfterMove(0, self.ingredients().length - 1, ingredients.peek());
    }
    
    self.afterMove = function(arg) {
        AfterMove((arg.sourceIndex < arg.targetIndex ? arg.sourceIndex : arg.targetIndex), (arg.sourceIndex >= arg.targetIndex ? arg.sourceIndex : arg.targetIndex), self.directions.peek());
    }
}

function DirectionViewModel() {
    var self = this;
    self.directions = ko.observableArray();
    
    self.addDirection = function() {
        self.directions.push(new Direction("", self.directions().length));
    }
    
    self.removeDirection = function(direction) {
        self.directions.remove(direction);
        AfterMove(0, self.directions().length - 1, self.directions.peek());
    }
    
    self.afterMove = function(arg) {
        AfterMove((arg.sourceIndex < arg.targetIndex ? arg.sourceIndex : arg.targetIndex), (arg.sourceIndex >= arg.targetIndex ? arg.sourceIndex : arg.targetIndex), self.directions.peek());
    }
}

function AfterMove(min, max, vm) {
    while (min <= max) {
        vm[min].order(min++);
    }
}

$(document).ready(function() {
    try
    {
        ko.applyBindings(new IngredientsViewModel(), document.getElementById('Ingredients'));
        ko.applyBindings(new DirectionViewModel(), document.getElementById('Directions'));
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
	<?php echo $this->Form->create('Recipe'); ?>
	<fieldset>
		<legend>
			<?php echo __('Add Recipe'); ?>
		</legend>
		<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('source');
		?>
	</fieldset>

	<fieldset id="Ingredients">
		<legend>The Ingredients</legend>
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
				data-bind="sortable : {data: ingredients, afterMove: afterMove}">
				<tr>
					<td><input type="hidden"
						data-bind="value: order, attr: { id: IngredientOrderID, name: IngredientOrderName}"></input><a
						href="#" data-bind="click: $root.removeIngredient">Remove</a>
					</td>
					<td><input type="text"
						data-bind="value: ingredient, attr: { id: IngredientID, name: IngredientName}" />
					</td>
					<td><input type="text"
						data-bind="value: amount, attr: { id: IngredientAmountID, name: IngredientAmountName}" />
					</td>
					<td><input type="checkbox"
						data-bind="checked: optional, attr: { id: IngredientOptionalID, name: IngredientOptionalName}" />
					</td>
				</tr>
			</tbody>
		</table>
	</fieldset>
	<fieldset id="Directions">
		<legend>The Directions</legend>
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
			<tbody
				data-bind="sortable : {data: directions, afterMove: afterMove}">
				<tr>
					<td><span
						data-bind="text: DisplayOrder, attr: { id: DirectionOrderID, name: DirectionOrderName}"></span>
					</td>
					<td><input type="text"
						data-bind="value: direction, attr: {id: DirectionID, name: DirectionName}" />
					</td>
					<td><a href="#" data-bind="click: $root.removeDirection">Remove</a>
					</td>
				</tr>
			</tbody>
		</table>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3>
		<?php echo __('Actions'); ?>
	</h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Recipes'), array('action' => 'index')); ?>
		</li>
		<li><?php echo $this->Html->link(__('List Directions'), array('controller' => 'directions', 'action' => 'index')); ?>
		</li>
		<li><?php echo $this->Html->link(__('New Direction'), array('controller' => 'directions', 'action' => 'add')); ?>
		</li>
		<li><?php echo $this->Html->link(__('List Ingredients'), array('controller' => 'ingredients', 'action' => 'index')); ?>
		</li>
		<li><?php echo $this->Html->link(__('New Ingredient'), array('controller' => 'ingredients', 'action' => 'add')); ?>
		</li>
	</ul>
</div>

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

    self.ShowRemove = ko.computed(function() {
		return self.order() != 0;
    });

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

    self.ShowRemove = ko.computed(function() {
		return self.order() != 0;
    });
    
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
    self.ingredients = ko.observableArray([new Ingredient(0, "", "", false)]);

    self.addIngredient = function() {
        var txtInsertXIngredients = document.getElementById("txtInsertXIngredients"); 
    	var numIngredients = txtInsertXIngredients.value;
    	txtInsertXIngredients.value = "";
    	
    	if (isNaN(numIngredients) || numIngredients == "") {
        	numIngredients = 1;
    	}
    	numIngredients = parseInt(numIngredients);
    	for (var i = 0; i < numIngredients; i++) {
        	self.ingredients.push(new Ingredient(self.ingredients().length, "", "", false));
    	}
    }
    
    self.removeIngredient = function(ingredient) {
    	if (self.ingredients.peek().length == 1)
            return;
        self.ingredients.remove(ingredient);
        AfterMove(0, self.ingredients().length - 1, ingredients.peek());
    }
    
    self.afterMove = function(arg) {
        AfterMove((arg.sourceIndex < arg.targetIndex ? arg.sourceIndex : arg.targetIndex), (arg.sourceIndex >= arg.targetIndex ? arg.sourceIndex : arg.targetIndex), self.directions.peek());
    }
}

function DirectionViewModel() {
    var self = this;
    self.directions = ko.observableArray([new Direction("", 0)]); 
    
    self.addDirection = function() {
		var txtInsertXDirections = document.getElementById("txtInsertXDirections");
    	var numDirections = txtInsertXDirections.value;
    	txtInsertXDirections.value = "";
    	
    	if (isNaN(numDirections) || numDirections == "") {
    		numDirections = 1;
    	}
    	numDirections = parseInt(numDirections);
    	for (var i = 0; i < numDirections; i++) {
    		self.directions.push(new Direction("", self.directions().length));
    	}
    }
    
    self.removeDirection = function(direction) {
        if (self.directions.peek().length == 1)
            return;
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

var ingredients, directions;
$(document).ready(function() {
    try
    {
        ingredients = new IngredientsViewModel();
        directions = new DirectionViewModel();
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
	<?php echo $this->Form->create('Recipe', array('onsubmit'=>'return OnFormSubmit(event);')); ?>
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
					<td><span data-bind="visible: ShowRemove"> <input type="hidden"
							data-bind="value: order, attr: { id: IngredientOrderID, name: IngredientOrderName}"></input><a
							href="#" data-bind="click: $root.removeIngredient">Remove</a>
					</span>
					</td>
					<td>
						<div class="input text required">
							<input type="text" required
								data-bind="value: ingredient, attr: { id: IngredientID, name: IngredientName}" />
						</div>
					</td>
					<td>
						<div class="input text required">
							<input type="text" required
								data-bind="value: amount, attr: { id: IngredientAmountID, name: IngredientAmountName}" />
						</div>
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
			<tbody
				data-bind="sortable : {connectClass: 'ko_containerDirections', data: directions, afterMove: afterMove}">
				<tr>
					<td><span data-bind="text: DisplayOrder"></span> <input
						type="hidden"
						data-bind="value: order, attr: { id: DirectionOrderID, name: DirectionOrderName}"></input>
					</td>
					<td>
						<div class="input text required">
							<input type="text" required
								data-bind="value: direction, attr: {id: DirectionID, name: DirectionName}" />
						</div>
					</td>
					<td><span data-bind="visible: ShowRemove"> <a href="#"
							data-bind="click: $root.removeDirection">Remove</a>
					</span>
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

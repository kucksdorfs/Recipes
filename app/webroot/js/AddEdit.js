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

function IngredientsViewModel(txtAddNumIngredients) {
	var self = this;
	self.ingredients = ko.observableArray([ new Ingredient(0, "", "", false) ]);
	self.txtInsertXIngredients = txtAddNumIngredients;

	self.addIngredient = function() {
		var numIngredients = txtInsertXIngredients.value;
		txtInsertXIngredients.value = "";

		if (isNaN(numIngredients) || numIngredients == "") {
			numIngredients = 1;
		}
		numIngredients = parseInt(numIngredients);
		for ( var i = 0; i < numIngredients; i++) {
			self.ingredients.push(new Ingredient(self.ingredients().length, "",
					"", false));
		}
	};

	self.removeIngredient = function(ingredient) {
		if (self.ingredients.peek().length == 1)
			return;
		self.ingredients.remove(ingredient);
		AfterMove(0, self.ingredients().length - 1, ingredients.peek());
	};

	self.afterMove = function(arg) {
		AfterMove((arg.sourceIndex < arg.targetIndex ? arg.sourceIndex
				: arg.targetIndex),
				(arg.sourceIndex >= arg.targetIndex ? arg.sourceIndex
						: arg.targetIndex), self.ingredients.peek());
	};
}

function DirectionViewModel(txtAddNumIngredients) {
	var self = this;
	self.directions = ko.observableArray([ new Direction("", 0) ]);
	self.txtInsertXDirections = txtAddNumIngredients;

	self.addDirection = function() {
		var numDirections = txtInsertXDirections.value;
		txtInsertXDirections.value = "";

		if (isNaN(numDirections) || numDirections == "") {
			numDirections = 1;
		}
		numDirections = parseInt(numDirections);
		for ( var i = 0; i < numDirections; i++) {
			self.directions.push(new Direction("", self.directions().length));
		}
	};

	self.removeDirection = function(direction) {
		if (self.directions.peek().length == 1)
			return;
		self.directions.remove(direction);
		AfterMove(0, self.directions().length - 1, self.directions.peek());
	};

	self.afterMove = function(arg) {
		AfterMove((arg.sourceIndex < arg.targetIndex ? arg.sourceIndex
				: arg.targetIndex),
				(arg.sourceIndex >= arg.targetIndex ? arg.sourceIndex
						: arg.targetIndex), self.directions.peek());
	};
}

function AfterMove(min, max, vm) {
	while (min <= max) {
		vm[min].order(min++);
	}
}

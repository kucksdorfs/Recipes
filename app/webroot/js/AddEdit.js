function Ingredient(order, ingredient, amount, optional, uniqueID) {
	var self = this;
	self.order = ko.observable(order);
	self.ingredient = ko.observable(ingredient);
	self.amount = ko.observable(amount);
	self.optional = ko.observable(optional);
	self.uniqueID = uniqueID;

	self.ShowRemove = ko.computed(function() {
		return self.order() != 0;
	});

	//Name fields
	self.IngredientName_ID = ko.computed(function() {
		return GetNamePrefix(self.order) + "[id]";
	});
	self.IngredientName_Order = ko.computed(function() {
		return GetNamePrefix(self.order) + "[order]";
	});
	
	self.IngredientName_Ingredient = ko.computed(function() {
		return GetNamePrefix(self.order) + "[ingredient]";
	});
	
	self.IngredientName_Amount = ko.computed(function() {
		return GetNamePrefix(self.order) + "[amount]";
	});
	
	self.IngredientName_Optional = ko.computed(function() {
		return GetNamePrefix(self.order) + "[optional]";
	});

	function GetNamePrefix(id) {
		return "data[Ingredient][" + id().toString() + "]";
	}
	
	//ID fields
	self.IngredientID_ID = ko.computed(function() {
		return GetIDPrefix(self.order) + "ID"
	});
	
	self.IngredientID_Order = ko.computed(function() {
		return GetIDPrefix(self.order) + "Order";
	});

	self.IngredientID_Ingredient = ko.computed(function() {
		return GetIDPrefix(self.order) + "Ingredient";
	});

	self.IngredientID_Amount = ko.computed(function() {
		return GetIDPrefix(self.order) + "Amount";
	});

	self.IngredientID_Optional = ko.computed(function() {
		return GetIDPrefix(self.order) + "Optional";
	});

	function GetIDPrefix(id) {
		return "ingredient" + id().toString();
	}
}

function Direction(direction, order, uniqueID) {
	var self = this;
	self.direction = ko.observable(direction);
	self.order = ko.observable(order);
	self.uniqueID = uniqueID;

	self.ShowRemove = ko.computed(function() {
		return self.order() != 0;
	});

	self.DisplayOrder = ko.computed(function() {
		return self.order() + 1;
	});

	//Name fields
	self.DirectionsName_ID = ko.computed(function() {
		return GetNamePrefix(self.order) + "[id]";
	});
	
	self.DirectionName_Direction = ko.computed(function() {
		return GetNamePrefix(self.order) + "[direction]";
	});

	self.DirectionName_Order = ko.computed(function() {
		return GetNamePrefix(self.order) + "[order]";
	});

	function GetNamePrefix(id) {
		return "data[Direction][" + id().toString() + "]";
	}

	//ID fields
	self.DirectionsID_ID = ko.computed(function() {
		return GetIDPrefix(self.order) + "ID";
	});
	
	self.DirectionID_Direction = ko.computed(function() {
		return GetIDPrefix(self.order) + "Direction";
	});

	self.DirectionID_Order = ko.computed(function() {
		return GetIDPrefix(self.order) + "Order";
	});

	function GetIDPrefix(id) {
		return "direction" + id().toString();
	}
}

function IngredientsViewModel(txtAddNumIngredients, previousIngredients) {
	var self = this;
	self.ingredients = ko.observableArray();
	self.txtInsertXIngredients = txtAddNumIngredients;
	
	if (!previousIngredients) {
		self.ingredients.push(new Ingredient(self.ingredients.length, "", "", false));
	}
	else {
		for (var i = 0; i < previousIngredients.length; i++) {
			self.ingredients.push(new Ingredient(i, previousIngredients[i]["Ingredient"], previousIngredients[i]["Amount"], previousIngredients[i]["Optional"], previousIngredients[i]["ID"]));
		}
	}

	self.addIngredient = function() {
		var numIngredients = self.txtInsertXIngredients.value;
		self.txtInsertXIngredients.value = "";

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
		var okToRemove = true;
		if (self.ingredients.peek().length == 1)
			return;
		if (!!ingredient.uniqueID) {
			okToRemove = false;
			$.ajax({
				url: webRoot + '/Ingredients/delete/' + ingredient.uniqueID,
				type: 'POST',
				async: false,
				complete: function(jqXHR, textStatus) {
					okToRemove = (jqXHR.status == 200);
				}
			});
		}
		if (!okToRemove)
			return;
		self.ingredients.remove(ingredient);
		AfterMove(0, self.ingredients().length - 1, self.ingredients.peek());
	};

	self.afterMove = function(arg) {
		AfterMove((arg.sourceIndex < arg.targetIndex ? arg.sourceIndex
				: arg.targetIndex),
				(arg.sourceIndex >= arg.targetIndex ? arg.sourceIndex
						: arg.targetIndex), self.ingredients.peek());
	};
}

function DirectionViewModel(txtAddNumIngredients, previousDirections) {
	var self = this;
	self.directions = ko.observableArray();
	self.txtInsertXDirections = txtAddNumIngredients;
	
	if (!previousDirections) {
		self.directions.push(new Direction("", 0));
	}
	else {
		for (var i = 0; i < previousDirections.length; i++) {
			self.directions.push(new Direction(previousDirections[i]["Direction"], i, previousDirections[i]["ID"]));
		}
	}

	self.addDirection = function() {
		var numDirections = self.txtInsertXDirections.value;
		self.txtInsertXDirections.value = "";

		if (isNaN(numDirections) || numDirections == "") {
			numDirections = 1;
		}
		numDirections = parseInt(numDirections);
		for ( var i = 0; i < numDirections; i++) {
			self.directions.push(new Direction("", self.directions().length));
		}
	};

	self.removeDirection = function(direction) {
		var okToRemove = true;
		if (self.directions.peek().length == 1)
			return;
		if (!!direction.uniqueID) {
			okToRemove = false;
			$.ajax({
				url: webRoot + '/Directions/delete/' + direction.uniqueID,
				type: 'POST',
				async: false,
				complete: function(jqXHR, textStatus) {
					okToRemove = (jqXHR.status == 200);
				}
			});
		}
		if (!okToRemove)
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

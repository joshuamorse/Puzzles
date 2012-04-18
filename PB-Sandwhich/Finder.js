function Finder(obj) {
	// Represents the types of members this object will be finding.
    this.members = null;

	// Represents our incoming sandwich object.
    this.obj = null;

    /**
     * Acts as a constructor for this object.
	 * Sets various properties for future use.
	 *
	 * @return {void}
     */
    this.construct = function() {
		this.setObj();
        this.members = {
            'change': [],
            'function': [],
            'number': [],
            'string': []
        }
        this.setStringMembers();
        this.setFunctionMembers();
        this.setNumberMembers();
        this.setChangeMembers();
    }

	/**
     * Attempts to set the incoming object, should it indeed be an object.
	 * @return {void}
     */
	this.setObj = function() {
		if (typeof obj !== 'object') {
			throw 'The "Finder" object requires an object-type argument!';
			return false;
		}

		this.obj = obj;
	}

    /**
     * Outputs the members of our object that are strings.
	 * @return {void}
     */
    this.printStringMembers = function() {
        console.log('Printing string members...');
        console.log(this.members.string);
        console.log('');
    }

    /**
     * Outputs the members of our object that are numbers.
	 * @return {void}
     */
    this.printNumberMembers = function() {
        console.log('Printing number members...');
        console.log(this.members.number);
        console.log('');
    }

    /**
     * Outputs the members of our object that are functions.
	 * @return {void}
     */
    this.printFunctionMembers = function() {
        console.log('Printing function members...');
        console.log(this.members.function);
        console.log('');
    }

    /**
     * Outputs the members of our object that change our object.
	 * @return {void}
     */
    this.printChangeMembers = function() {
        console.log('Printing change members...');
        console.log(this.members.change);
        console.log('');
    }

    /**
     * Finds the members of our object that are strings.
	 * @return {void}
     */
    this.setStringMembers = function() {
        for (var i in this.obj) {
            if (typeof this.obj[i] === 'string') {
                this.members.string.push(this.obj[i]);
            }
        }
    }

    /**
     * Finds the return value of the members of our object that are functions.
	 * @return {void}
     */
    this.setFunctionMembers = function() {
        for (var i in this.obj) {
            if (typeof this.obj[i] === 'function' ) {
                this.members.function.push(this.obj[i]());
            }
        }
    }

    /**
     * Finds the function of the members of our object that change the object.
	 * @return {void}
     */
    this.setChangeMembers = function() {
        for (var i in this.obj) {
            if (typeof this.obj[i] === 'function') {
                if (this.obj[i]() === 'Jelly') {
                    this.members.change.push(this.obj[i]);
                }
            }
        }
    }

    /**
     * Finds the value of the members of our object that are numbers.
	 * @return {void}
     */
    this.setNumberMembers = function() {
        for (var i in this.obj) {
            if (typeof this.obj[i] === 'number') {
                if (this.obj[i] >= 5) {
                    this.members.number.push(this.obj[i]);
                }
            }
        }
    }

    return this.construct();
}

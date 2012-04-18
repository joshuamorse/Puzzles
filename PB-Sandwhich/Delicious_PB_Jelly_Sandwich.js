var sandwich = {};
for (var i=0; i<100; i++) {
  var memberName = "_" + Math.floor((Math.random()*100000)+1);
  var random = Math.floor(Math.random()*4);
  switch (random) {
    case 0: // Assign a random member that is a number
      sandwich[memberName] = Math.floor(Math.random()*10);
      break;
    case 1: // Assign a random member that is a string
      sandwich[memberName] = 'Delicious';
      break;
    case 2: // Assign a random member that is a function that returns a string
      sandwich[memberName] = function () { return 'PB'; };
      break;
    case 3: // Assign a random member that is a function that changes sandwich
      sandwich[memberName] = function () {
        var sandwichMembers = Object.keys(sandwich);
        var randMember = sandwichMembers[(Math.floor(Math.random() * sandwichMembers.length))];
        return sandwich[randMember] = 'Jelly';
      }
      break;
  }
}
/**** Rules
 ** You can solve this puzzle any way you want to within the following ruleset:
 * You cannot change the code above.
 * To print your solutions, use console.log('message') or console.dir(object/array/whatever)
 * This challenge is designed to test your ability to use javascript as well as your ability to debug and solve unusual problems
 **** Part 1
 ** Write functions that perform the following tasks (in order of increasing difficulty)
 * Finds and prints the members of sandwich that are a string
 * Finds and prints the return value of the members of sandwich that are a function
 * Finds and prints the members of sandwich that are an integer and are >= 5
 * Finds and prints (but never executes) the function implementation of the members of sandwich that change the sandwich object
 **** Part 2
 ** Tie all of your logic together to perform all of the previous tasks.
 * Show us your code organization and logical flow
 */

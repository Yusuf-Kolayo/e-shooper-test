var password = 'Q09w*&n=7?';
var possiblePasswords = [];

function generatePasswords(currentPassword, remainingCharacters) {
  if (remainingCharacters.length === 0) {
    possiblePasswords.push(currentPassword);
    return;
  }

  for (var i = 0; i < remainingCharacters.length; i++) {
    var char = remainingCharacters[i];
    var updatedPassword = currentPassword + char;
    var updatedRemainingCharacters = remainingCharacters.slice(0, i) + remainingCharacters.slice(i + 1);
    generatePasswords(updatedPassword, updatedRemainingCharacters);
  }
}

generatePasswords('', password);
console.log(possiblePasswords);
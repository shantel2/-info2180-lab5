window.onload = function() { 

    var button = document.getElementById("lookup");
    button.addEventListener("click", function(event) {
    event.preventDefault();

    var output = document.getElementById("result");

    var userInput = document.getElementById("country").value.replace(/[-&\/\\#,+()$@|~%!.'":;*?<>{}]/g,'');
    
    fetch(`http://localhost/info2180-lab5/world.php?country=${userInput}`, {method : 'GET'})
    .then(response => response.text())
    .then(data => {
        output.innerHTML = "";
        output.innerHTML = data; 
    })
    .catch(error => console.log("ERROR!"));
  });
};

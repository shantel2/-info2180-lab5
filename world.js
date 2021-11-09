window.onload = function() { 


    var button2 = document.getElementById("cities");
    button2.addEventListener("click", cityListner);

    var context = document.getElementById("cities");

    var output = document.getElementById("result");
    var button = document.getElementById("lookup");

    
    button.addEventListener("click", function(event) {
    event.preventDefault();

    let userInput = document.getElementById("country").value.replace(/[-&\/\\#,+()$@|~%!.'":;*?<>{}]/g,'');

    if (button2.id === "cities") {
      context = "cities";
    } else {
      context = ""; }


    fetch(`http://localhost/info2180-lab5/world.php?country=${userInput}`)
    .then(response => response.text())
    .then(data => {
        output.innerHTML = "";
        output.innerHTML = data; 
    })
    .catch(error => console.log("ERROR!"));
  });

  function cityListner(e){
    e.preventDefault();  
     let userInput = document.getElementById("country").value.replace(/[-&\/\\#,+()$@|~%!.'":;*?<>{}]/g,'');
  
    fetch(`http://localhost/info2180-lab5/world.php?country=${userInput}&context=${context}`)
    .then(response => response.text())
    .then(data => {
        output.innerHTML = "";
        output.innerHTML = data; 
    })
    .catch(error => console.log("ERROR!"));
  }
  
};


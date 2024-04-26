
function connexion(){

  document.querySelector(".btn").addEventListener("click", () => {
    console.log("ok");
    var change = document.querySelector(".connexion");
    
    change.classList.toggle("co");
  });
}
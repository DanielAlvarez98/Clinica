var campoFiltro = document.querySelector("#filtrar-tabla")
campoFiltro.addEventListener("input",function(){
    console.log(this.value);
     var personas = document.querySelectorAll(".persona");

    if(this.value.length > 0){
        for(var i=0; i<personas.length; i++){
            var persona = personas[i]
            var tdNombre = persona.querySelector(".info-nombre");
            var nombre =tdNombre.textContent;
            var expresion =new RegExp(this.value,"i");// mostrar lo que se escribe con o sin mayuscula
            if(!expresion.test(nombre)){
                persona.classList.add("invisible");
            }else{
                persona.classList.remove("invisible");
            }
        }
   }else{
        for(var i=0; i<personas.length; i++){
        var persona= personas[i];
        persona.classList.remove("invisible");
    }
   }
});




document.getElementById('photo').addEventListener('change', function (e) {
    var file = e.target.files[0];
    var reader = new FileReader();
    
    reader.onload = function (event) {
      document.getElementById('previewImage').setAttribute('src', event.target.result);
    }
  
    reader.readAsDataURL(file);
  });
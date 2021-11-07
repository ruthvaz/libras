inputFoto = document.getElementById("foto");
campoFoto = document.getElementById("preview");
iconeFoto = document.getElementById("icone-foto");

inputFoto.addEventListener("change", function(){

    if (inputFoto.files && inputFoto.files[0]) {
        var file = new FileReader();
        file.onload = function(e) {

            campoFoto.src = e.target.result;
            campoFoto.style.display = "flex";
            iconeFoto.style.display = "none";
        };       
        file.readAsDataURL(this.files[0]);
    }

});




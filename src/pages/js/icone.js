inputIcone = document.getElementById("icone");
campoIcone = document.getElementById("preview-icone");
textoPreviewIcone = document.getElementById("texto-preview-icone");

previewPosicao = document.getElementById("preview-posicao");
textoPreviewPosicao = document.getElementById("texto-preview-posicao");

inputPosicao = document.getElementById("posicao");

if(campoIcone.src != 'http://localhost/libras/src/uploads/licoes/icones/start-up.png') {
    campoIcone.style.display = "flex";
    previewPosicao.style.display = "flex";

    textoPreviewIcone.style.display = "none";
    textoPreviewPosicao.style.display = "none";
}

inputIcone.addEventListener("change", function(){

    if (inputIcone.files && inputIcone.files[0]) {
        var file = new FileReader();
        file.onload = function(e) {

            campoIcone.src = e.target.result;
            previewPosicao.src = e.target.result;

            campoIcone.style.display = "flex";
            previewPosicao.style.display = "flex";

            textoPreviewIcone.style.display = "none";
            textoPreviewPosicao.style.display = "none";
        };       
        file.readAsDataURL(this.files[0]);
    }

});

var licoes = document.getElementsByClassName("licao");

Array.prototype.forEach.call(licoes, function(licao) {
    licao.addEventListener("click", editaPosicao, false)
});

function editaPosicao() {
    inputPosicao.value = this.getAttribute("id-licao");
    previewPosicao.src = this.querySelector("img").src;
    previewPosicao.style.display = "flex";
    textoPreviewPosicao.style.display = "none";
}

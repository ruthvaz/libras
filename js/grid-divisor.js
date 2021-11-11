// Pega a quantidade de lições
var numLicoes = document.getElementsByClassName("lesson").length;
// Pega a ultima lição
var ultimaLicao = document.querySelector(".lesson:last-child");

// Se o número de Lições for par, o Layout grid da ultima Lição será igual ao da primeira
if(numLicoes % 2 == 0) {
    ultimaLicao.style.gridColumnStart = "1";
    ultimaLicao.style.gridColumnEnd = "3";
}
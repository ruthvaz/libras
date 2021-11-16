// Pegar a referência dos elementos e guarda em uma variável
perfil = document.getElementsByClassName("menu-perfil")[0];
menu = document.getElementsByClassName("perfil-menu")[0];
close = document.getElementsByClassName("btn-close-menu")[0];

/** 
 * Fica escutando os eventos de click no menu do perfil, e quando ocorre
 * algum click, ele chama uma função que da um estilo de exibição do tipo 'herado'
 * para o menu que estava oculto, com estilo de exibição 'none'.
*/
perfil.addEventListener("click", function() {
    menu.style.display = "inherit";
});

/** 
 * Fica escutando os eventos de click no botão de fechar, e quando ocorre
 * algum click, ele chama uma função que da um estilo de exibição do tipo 'none'
 * para o menu que estava sendo exibido com estilo de exibição 'herdado'.
*/
close.addEventListener("click", function() {
    menu.style.display = "none";
});
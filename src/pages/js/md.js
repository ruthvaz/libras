// textarea
artigo  = document.getElementById('artigo');

// div do preview
preview = document.getElementById('artigo-preview')

var converter = new showdown.Converter();


artigo.addEventListener('change', function() {

    // pega o texto do artigo (em markdown)
    text = artigo.value;

    // converte o texto em md para html
    html = converter.makeHtml(text);

    preview.innerHTML = html;

});


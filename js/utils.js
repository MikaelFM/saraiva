let contador = 0;
if(typeof localStorage['tema'] == 'undefined'){
    localStorage['tema'] = contador;
} else {
    contador = localStorage['tema'];
}
createNavFooter('nav', ['HOME', 'SOBRE', 'CONTATO'], 'saraivaLogo', 'innerText');

createNavFooter('footer', ['bi bi-facebook', 'bi bi-youtube', 'bi bi-twitter', 'bi bi-instagram'], 'saraivaLogoBranco', 'classList');

headDefine()
mudaTema()

span = document.createElement('span');
span.innerText = 'Desenvolvido em IFRS Campus Farroupilha';
document.querySelector('footer').appendChild(span);

document.addEventListener('load', createNavFooter)

function createNavFooter (tag, optionsList, logoId, property) {
    title = document.title.split(' ')[0].toUpperCase();
    links = {'HOME' : './home.html', 'SOBRE' : './sobre.html', 'CONTATO' : './contato.html', 'bi bi-facebook' : 'https://pt-br.facebook.com/saraivaonline/', 'bi bi-youtube' : 'https://www.youtube.com/channel/UC5kzTn_Okk-xUu2IShP9Luw', 'bi bi-twitter' : 'https://twitter.com/Saraiva', 'bi bi-instagram' : 'https://www.instagram.com/saraivaonline/'};
    element = document.createElement(tag);
    list = document.createElement("ul");
    logo = document.createElement("div");
    logo.id = logoId;
    for(cont in optionsList){
        li = document.createElement("li");
        el = document.createElement("a");
        el[property] = optionsList[cont];
        if(optionsList[cont] != title){
            el.href = links[optionsList[cont]]
        } else {
            el.href = '#'
            el.classList = 'thisPag'
        }
        li.appendChild(el);
        list.appendChild(li);
    }
    if(tag == 'nav'){
        list.insertAdjacentElement("afterbegin", button());
    }
    element.appendChild(list);
    element.appendChild(logo);
    if(tag == 'nav'){
        document.body.insertAdjacentElement("afterbegin", element);
    } else if (tag == 'footer'){
        document.body.appendChild(element);   
    }
}

document.head
function headDefine(){
    head = document.head
    head.innerHTML += '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">'
    head.innerHTML += '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />'
    head.innerHTML += '<link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">'
    head.innerHTML += '<link rel="stylesheet" href="../css/utils.css">'
    head.innerHTML += '<link rel="stylesheet" href="../css/root-black.css">'
}

function after(el){
    if (el.value != '' && contador % 2 == 0){
        el.style.color = 'white';
    } else if (el.value != '' && contador % 2 == 0){
        el.style.color = 'black';
    } 
}
function button(){
    li = document.createElement('li');
    icon = document.createElement('i')
    icon.classList = 'fa-solid fa-circle-half-stroke'
    icon.addEventListener('click', buttonTheme)
    li.appendChild(icon)
    return li
}
function buttonTheme(){
    contador++
    mudaTema()
}
function mudaTema(){
    if(contador % 2 == 0){
        head.innerHTML = (head.innerHTML).replace('<link rel="stylesheet" href="../css/root-white.css">', '<link rel="stylesheet" href="../css/root-black.css">')
    } else if (contador % 2 == 1){
        head.innerHTML = (head.innerHTML).replace('<link rel="stylesheet" href="../css/root-black.css">', '<link rel="stylesheet" href="../css/root-white.css">')
    }
    localStorage['tema'] = contador;
}
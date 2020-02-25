

function menuInicial() {
    closeNav();
}

function openNav() {
    document.getElementById("menu").style.width = "240px";
    document.getElementById("main").style.marginLeft = "240px";
    document.getElementById("main").style.width = "85%";
    document.getElementById("elementos").hidden = false;
    document.getElementById("menu").style.backgroundColor = "#003B5C";
}

function closeNav() {
    document.getElementById("elementos").hidden = true;
    document.getElementById("menu").style.backgroundColor = "#003B5C";
    document.getElementById("menu").style.width = "0px";
    document.getElementById("main").style.marginLeft = "0px";
    document.getElementById("main").style.width = "100%";
    
}


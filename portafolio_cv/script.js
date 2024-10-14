let menuVisible = false;
//Función que oculta el menú
function mostrarOcultarMenu(){
    if(menuVisible) {
        document.getElementById("nav").classList = "";
        menuVisible = false;
    }else {
        document.getElementById("nav").classList = "responsive";
        menuVisible = true;
    }
}

function seleccionar(){
    //Oculto en el menú una vez que selecciono una opción
    document.getElementById("nav").classList = "";
    menuVisible = false;
}

//Función que aplica las animaciones de las habilidades
function efectoHabilidades(){
    var skills = document.getElementById("skills");
    var distancia_skills = window.innerHeight - skills.getBoundingClientRect().top;
    if(distancia_skills >= 300) {
        let habilidades = document.getElementsByClassName("progreso");
        habilidades[0].classList.add("javascript");
        habilidades[1].classList.add("htmlCss");
        habilidades[2].classList.add("java");
        habilidades[3].classList.add("c");
        habilidades[4].classList.add("sql");
        habilidades[5].classList.add("windows");
        habilidades[6].classList.add("linux");
        habilidades[7].classList.add("microsoft");
        habilidades[8].classList.add("comunicacion");
        habilidades[9].classList.add("trabajoEquipo");
        habilidades[10].classList.add("creatividad");
        habilidades[11].classList.add("dedicacion");
        habilidades[12].classList.add("resiliencia");
        habilidades[13].classList.add("compromiso");
    }
}

//Detector de scrolling para aplicar la animación de la barra de habilidades
window.onscroll = function(){
    efectoHabilidades();
}

//Boton de descarga CV
const descargaCvBtn = document.querySelector(".descargaCvBtn");

// Link Google Drive
const fileLink = "https://drive.google.com/file/d/1XsGyx6MFSeaYwVViQ5JORBkCscqaDx8k/view?usp=share_link";

const initTimer = () => {
    //Ingresar el atributo data-timer en el HTML
    let timer = descargaCvBtn.dataset.timer;
    descargaCvBtn.classList.add("timer");
    descargaCvBtn.innerHTML = `La descarga comienza en <b>${timer}</b> segundos`;

    const initCounter = setInterval (() => {
        if (timer > 0) {
            timer--;
            return descargaCvBtn.innerHTML = `La descarga comienza en <b>${timer}</b> segundos`;
        }
        clearInterval(initCounter);
        location.href = fileLink;
        descargaCvBtn.textContent = "Descargando...";
    },1000) 
};

descargaCvBtn.addEventListener("click", initTimer)


//Boton de descarga CV
const descargaProyectoBtn = document.querySelector(".descargaProyectoBtn");

// Link Google Drive
const fileLink2 = "https://drive.google.com/file/d/1JDNlYh_UoQAFOb24H2M8GedwgSUZ_i8d/view?usp=share_link";

const initTimer2 = () => {
    //Ingresar el atributo data-timer en el HTML
    let timer = descargaProyectoBtn.dataset.timer;
    descargaProyectoBtn.classList.add("timer");
    descargaProyectoBtn.innerHTML = `La descarga comienza en <b>${timer}</b> segundos`;

    const initCounter2 = setInterval (() => {
        if (timer > 0) {
            timer--;
            return descargaProyectoBtn.innerHTML = `La descarga comienza en <b>${timer}</b> segundos`;
        }
        clearInterval(initCounter2);
        location.href = fileLink2;
        descargaProyectoBtn.textContent = "Descargando...";
    },1000) 
};

descargaProyectoBtn.addEventListener("click", initTimer2)
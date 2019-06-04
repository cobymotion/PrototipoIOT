/**
 * Script del front para animación
 * Luis Cobián
 * 1 de Junio 2019
 */

// variables del lienzo donde se manejara la animación
var miCanvas, ctx;
// variables que se necesitan para el primer cajon (auto )
var img1DespY, img1X, img1Y, ocupado1, interval1,animation1;
// variables que se necesitan para el primer cajon (auto )
var img2DespY, img2X, img2Y, ocupado2, interval2, animation2;
// variable de bloqueo ante las peticiones
var lock = false;


//inicialización del canvas
miCanvas = document.getElementById("canvasAnimation");
ctx = miCanvas.getContext("2d");

// inicializar con las imagenes
var carImg1 = new Image();
carImg1.src="imgs/car.png";
// generar un duplicado del auto
carImg2 = carImg1;

/// variables para los estados que tienen los cajones
ocupado1 = false;
ocupado2 = false;
// posición de los dos autos
img1X = 97;
img2X = 165;
img1Y = img2Y = 140;

/// Cuando la imagen se cargue se pinta.
carImg1.onload = function(){
    ctx.drawImage(carImg1,img1X,img1Y,46,90);
    ctx.drawImage(carImg2,img2X,img2Y,46,90);
}


// se manda llamar el loopMain para que empiece la animación
setInterval(loopMain,3000)


/// Metodo cuando existe un cambio en el cajon 1 ya se ocupado o libre
function ocupar1(){
    if(!animation1){
        if(ocupado1){
            img1DespY = 1;
            ocupado1 = false;
        }else {
            img1DespY = -1;
            ocupado1 = true;
        }
        animation1=true;
        interval1 = setInterval(moveCar1,20); // cada 20 milisegundos se ejecute
    }
}


// Metodo para animar el primer auto
function moveCar1(){
    ctx.clearRect(img1X,img1Y,46,90);
    img1Y = img1Y + img1DespY;
    ctx.drawImage(carImg1,img1X,img1Y,46,90);
    if(img1Y<=28||img1Y>=140)
    {
        animation1=false;
        clearInterval(interval1); // cancelar el ciclo
    }

}


/// Metodo cuando existe un cambio en el cajon 1 ya se ocupado o libre
function ocupar2(){
    if(!animation2){
        if(ocupado2){
            img2DespY = 1;
            ocupado2 = false;
        }else {
            img2DespY = -1;
            ocupado2 = true;
        }
        animation2=true;
        interval2 = setInterval(moveCar2,20);
    }
}

// Metodo para animar el primer auto
function moveCar2(){
    ctx.clearRect(img2X,img2Y,46,90);
    img2Y = img2Y + img2DespY;
    ctx.drawImage(carImg2,img2X,img2Y,46,90);
    if(img2Y<=28||img2Y>=140)
    {
        animation2=false;
        clearInterval(interval2);
    }

}

/// metodo que se esta ejecutando infinitamente mientras se esta visualizando
function loopMain() {
    if(!lock && !animation1 && !animation2){
        lock = true;
        $.get("phps/refreshlugares.php",function(responseText,status){
            try{
                if(status=="success"){
                    res = JSON.parse(responseText);
                    res.forEach(function (lugar) {
                        switch (lugar.idLugares) {
                            case "1":
                                if(ocupado1!=parseInt(lugar.ocupado))
                                    ocupar1();
                                break;
                            case "2":
                                if(ocupado2!=parseInt(lugar.ocupado))
                                    ocupar2();
                                break;
                        }
                    });
                }else{
                    alert(status);
                }
            }catch(e){
                alert(e);
            }
            lock = false;
        });
    }
}
function showAlert(msg) {
    alert(msg);
}

function notValidForm(){
    window.history.back();
}

const openModalButtons = document.querySelectorAll('[data-modal-target]')
const closeModalButtons = document.querySelectorAll('[data-close-button]')
const overlay = document.getElementById('overlay')

openModalButtons.forEach(button => {
    button.addEventListener('click', () => {
        const modal = document.querySelector(button.dataset.modalTarget)
        openModal(modal)
    })
})

overlay.addEventListener('click', () => {
    const modals = document.querySelectorAll('.model.active')
    modals.forEach(modal => {
        closeModal(modal)
    })
})

closeModalButtons.forEach(button => {
    button.addEventListener('click', () => {
        const modal = button.closest('.model')
        closeModal(modal)
    })
})

function openModal(modal) {
    if (modal == null) return
    modal.classList.add('active')
    overlay.classList.add('active')
}

function closeModal(modal) {
    if (modal == null) return
    modal.classList.remove('active')
    overlay.classList.remove('active')
}


function setModal(title, category, popis, userEmail, price, numImages, image1, image2, image3, image4, image5) {
    setSlides(numImages);
    document.getElementById("title").innerHTML = title;
    document.getElementById("kategoria").innerHTML = category;
    document.getElementById("imageGalery").style.display = "none";
    if (numImages > 0) {
        document.getElementById("imageGalery").style.display = "block";
        document.getElementsByClassName("image1")[0].src = image1;
        document.getElementsByClassName("image1")[1].src = image1;
        document.getElementsByClassName("image2")[0].src = image2;
        document.getElementsByClassName("image2")[1].src = image2;
        document.getElementsByClassName("image3")[0].src = image3;
        document.getElementsByClassName("image3")[1].src = image3;
        document.getElementsByClassName("image4")[0].src = image4;
        document.getElementsByClassName("image4")[1].src = image4;
        document.getElementsByClassName("image5")[0].src = image5;
        document.getElementsByClassName("image5")[1].src = image5;
    }
    document.getElementById("popis").innerHTML = popis;
    document.getElementById("usrEmail").innerHTML = userEmail;
    document.getElementById("usrEmail").href = "mailto:" + userEmail;
    document.getElementById("price").innerHTML = "Cena: " + price;
}
function edit(id, title, popis, price) {
    document.getElementById("idUpdate").setAttribute('value', parseInt(id));
    document.getElementById("titleUpdate").innerHTML = "Uprava inzeratu: " + title;
    document.getElementById("nadpisUpdate").setAttribute('value', title);
    document.getElementById("popisUpdate").innerHTML = popis;
    document.getElementById("cenaUpdate").setAttribute('value', parseFloat(price));
}

//obrazkova galeria
var slideIndex = 1;
var numImages = 0;
function setSlides(pNumImages) {
    slideIndex = 1;
    numImages = pNumImages;
    showSlides(slideIndex);
}

// sipky kontrola dalsi predchadzajuci
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// male obrazky dole kontrola
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
/*
    var captionText = document.getElementById("caption");
*/
    if (n > numImages) {slideIndex = 1}
    if (n < 1) {slideIndex = parseInt(numImages)}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
        dots[i].style.display = "block";
    }
    for (i = numImages; i < dots.length; i++) {
        dots[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    /*captionText.innerHTML = dots[slideIndex-1].alt;*/
}

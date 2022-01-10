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

    document.getElementById("title").innerHTML = title;
    document.getElementById("kategoria").innerHTML = category;
    if (numImages > 4) {
        document.getElementById("image5").src = image5;
    }
    if (numImages > 3) {
        document.getElementById("image4").src = image4;
    }
    if (numImages > 2) {
        document.getElementById("image3").src = image3;
    }
    if (numImages > 1) {
        document.getElementById("image2").src = image2;
    }
    if (numImages > 0) {
        document.getElementById("image1").src = image1;
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
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    captionText.innerHTML = dots[slideIndex-1].alt;
}

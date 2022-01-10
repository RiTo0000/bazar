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


function setModal(title, category, popis, userEmail, price, image) {
    document.getElementById("title").innerHTML = title;
    document.getElementById("kategoria").innerHTML = category;
    if (image.localeCompare("") == 0) {
        document.getElementById("image").style.display = "none";
    }
    else {
        document.getElementById("image").style.display = "block";
        document.getElementById("image").src = image;
    }
    document.getElementById("image").src = image;
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


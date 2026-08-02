const btn = document.getElementById('backToTop');

window.addEventListener('scroll', function () {
  const nav = document.getElementById('top-nav');
  if(this.window.innerWidth<1060){
    
    if (this.window.scrollY>270){
      btn.classList.add('seen');
    }
    else{
      btn.classList.remove('seen');
    }

    if(this.window.innerWidth>800){
      if(this.window.scrollY>=20){
        nav.classList.add('fixed');
      }
      else{
        nav.classList.remove('fixed');
      }
    }
  }
  else{

    if (window.scrollY >= 20) {
      nav.classList.add('fixed');
    } else {
      nav.classList.remove('fixed');
    }
  }
  
});

const mobNav = document.getElementById("mobile-nav");
const topNav = document.getElementById("top-nav");
const flipcard = document.getElementById("flipper");
const flipcard1 = document.getElementById("flipper1");
const flipcard2 = document.getElementById("flipper2");
const flipcard3 = document.getElementById("flipper3");
const flipcard4 = document.getElementById("flipper4");
const flipcard5 = document.getElementById("flipper5");
const flipcard6 = document.getElementById("flipper6");
const flipcard7 = document.getElementById("flipper7");
const flipcard8 = document.getElementById("flipper8");

flipcard.addEventListener('click', function(){

  this.classList.toggle("is-flipped");
});

flipcard1.addEventListener('click', function(){

  const isTouchDevice = !window.matchMedia("(hover: hover)").matches;

  if(isTouchDevice){
    this.classList.toggle("is-flipped");
  }
});

flipcard2.addEventListener('click', function(){

  const isTouchDevice = !window.matchMedia("(hover: hover)").matches;

  if(isTouchDevice){
    this.classList.toggle("is-flipped");
  }
});

flipcard3.addEventListener('click', function(){

  const isTouchDevice = !window.matchMedia("(hover: hover)").matches;

  if(isTouchDevice){
    this.classList.toggle("is-flipped");
  }
});

flipcard4.addEventListener('click', function(){

  const isTouchDevice = !window.matchMedia("(hover: hover)").matches;

  if(isTouchDevice){
    this.classList.toggle("is-flipped");
  }
});

flipcard5.addEventListener('click', function(){

  const isTouchDevice = !window.matchMedia("(hover: hover)").matches;

  if(isTouchDevice){
    this.classList.toggle("is-flipped");
  }
});

flipcard6.addEventListener('click', function(){

  const isTouchDevice = !window.matchMedia("(hover: hover)").matches;

  if(isTouchDevice){
    this.classList.toggle("is-flipped");
  }
});

flipcard7.addEventListener('click', function(){

  const isTouchDevice = !window.matchMedia("(hover: hover)").matches;

  if(isTouchDevice){
    this.classList.toggle("is-flipped");
  }
});

flipcard8.addEventListener('click', function(){

  const isTouchDevice = !window.matchMedia("(hover: hover)").matches;

  if(isTouchDevice){
    this.classList.toggle("is-flipped");
  }
});

document.getElementById("burgerBtn").onclick = function(){
  window.scrollTo({top: 0, behavior: 'smooth'});
  mobNav.classList.add("active");
  topNav.classList.add("ukryty");
  document.body.classList.add("noscroll");
};

document.getElementById("closeBtn").onclick = function(){
  mobNav.classList.remove("active");
  topNav.classList.remove("ukryty");
  document.body.classList.remove("noscroll");
};

document.getElementById("about_menu").onclick = function(){
  mobNav.classList.remove("active");
  topNav.classList.remove("ukryty");
  document.body.classList.remove("noscroll");

  const sekcjaAbout = document.getElementById("about"); 
  sekcjaAbout.scrollIntoView({behavior: 'smooth'});
};

document.getElementById("wina_menu").onclick = function(){
  mobNav.classList.remove("active");
  topNav.classList.remove("ukryty");
  document.body.classList.remove("noscroll");

  const sekcjaWina = document.getElementById("wina"); 
  sekcjaWina.scrollIntoView({behavior: 'smooth'});
};

document.getElementById("oferta_menu").onclick = function(){
  mobNav.classList.remove("active");
  topNav.classList.remove("ukryty");
  document.body.classList.remove("noscroll");

  const sekcjaOferta = document.getElementById("oferta"); 
  sekcjaOferta.scrollIntoView({behavior: 'smooth'});
};

document.getElementById("kontakt_menu").onclick = function(){
  mobNav.classList.remove("active");
  topNav.classList.remove("ukryty");
  document.body.classList.remove("noscroll");

  const sekcjaKontakt = document.getElementById("kontakt"); 
  sekcjaKontakt.scrollIntoView({behavior: 'smooth'});
};


document.getElementById("about_menu1").onclick = function(){
  const sekcjaAbout = document.getElementById("about"); 
  sekcjaAbout.scrollIntoView({behavior: 'smooth'});
};

document.getElementById("wina_menu1").onclick = function(){
  const sekcjaWina = document.getElementById("wina"); 
  sekcjaWina.scrollIntoView({behavior: 'smooth'});
};

document.getElementById("oferta_menu1").onclick = function(){
  const sekcjaOferta = document.getElementById("oferta"); 
  sekcjaOferta.scrollIntoView({behavior: 'smooth'});
};

document.getElementById("kontakt_menu1").onclick = function(){
  const sekcjaKontakt = document.getElementById("kontakt"); 
  sekcjaKontakt.scrollIntoView({behavior: 'smooth'});
};

document.getElementById("glowna_strona").onclick = function(){
  window.scrollTo({top: 0, behavior: 'smooth'});
}

btn.addEventListener('click', ()=>{
  window.scrollTo({top: 0, behavior: 'smooth'});
});


document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm'); // Upewnij się, że takie masz ID w HTML

    form.addEventListener('submit', async (e) => {
        e.preventDefault(); // To jest kluczowe - strona się nie odświeży!

        // Pobieramy dane z pól formularza
        const formData = new FormData(form);

        // Opcjonalnie: Zmień tekst przycisku na "Wysyłanie...", żeby użytkownik wiedział, że coś się dzieje
        const btn = form.querySelector('button');
        const originalBtnText = btn.innerText;
        btn.innerText = "Wysyłanie...";
        btn.disabled = true;

        try {
            // Wysyłamy dane do Twojego pliku php (zmień nazwę pliku jeśli jest inna)
            const response = await fetch('send.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.text();

            if (result.trim() === "success") {
                showToast("Wiadomość wysłana pomyślnie!", "#7b0a28");
                form.reset(); // Czyścimy pola po sukcesie
            } else {
                showToast("Błąd: " + result, "#ff5f6d");
            }
        } catch (error) {
            showToast("Błąd połączenia z serwerem", "#ff5f6d");
        } finally {
            // Przywracamy przycisk do stanu pierwotnego
            btn.innerText = originalBtnText;
            btn.disabled = false;
        }
    });
});

// Jedna uniwersalna funkcja do toastów
function showToast(message, color) {
    Toastify({
        text: message,
        duration: 4000,
        close: true,
        gravity: "top", 
        position: "right",
        stopOnFocus: true,
        style: {
            background: color,
            borderRadius: "8px"
        }
    }).showToast();
}
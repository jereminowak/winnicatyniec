const btn = document.getElementById('backToTop');

window.addEventListener('scroll', function () {
  const nav = document.getElementById('top-nav');
  if(this.window.innerWidth>1060){
    
    if (this.window.scrollY>270){
      btn.classList.add('seen');
    }
    else{
      btn.classList.remove('seen');
    }

    if (window.scrollY >= 20) {
      nav.classList.add('fixed');
    } else {
      nav.classList.remove('fixed');
    }
  }
  
});

const mobNav = document.getElementById("mobile-nav");
const topNav = document.getElementById("top-nav");

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
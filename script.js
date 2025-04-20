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
  mobNav.classList.remove("ukryty");
  topNav.classList.add("ukryty");
};

document.getElementById("closeBtn").onclick = function(){
  mobNav.classList.add("ukryty");
  topNav.classList.remove("ukryty");
};

btn.addEventListener('click', ()=>{
  window.scrollTo({top: 0, behavior: 'smooth'});
});
const btn = document.getElementById('backToTop');

window.addEventListener('scroll', function () {
  const nav = document.getElementById('top-nav');
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
});

btn.addEventListener('click', ()=>{
  window.scrollTo({top: 0, behavior: 'smooth'});
});
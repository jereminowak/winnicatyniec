window.addEventListener('scroll', function () {
  const nav = document.getElementById('top-nav');
  
  if(window.scrollY >= 100){
	  nav.classList.add('out');
  }
  else{
	  nav.classList.remove('out');
  }
  if (window.scrollY >= 650) {
    nav.classList.add('fixed');
	nav.classList.remove('out');
  } else {
    nav.classList.remove('fixed');
  }
});
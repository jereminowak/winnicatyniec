window.addEventListener('scroll', function () {
  const nav = document.getElementById('top-nav');
  
  if (window.scrollY >= 20) {
    nav.classList.add('fixed');
  } else {
    nav.classList.remove('fixed');
  }
});
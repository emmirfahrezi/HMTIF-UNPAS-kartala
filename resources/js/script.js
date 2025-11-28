const navbar = document.getElementById('navbar');

window.addEventListener('scroll', () => {
  const navElements = document.querySelectorAll(
    '#navbar a, #navbar button, #navbar div, #navbar span, #navbar h1',
  );

  if (window.scrollY > 50) {
    navbar.classList.remove('bg-transparent');
    navbar.classList.add('bg-white', 'shadow-md');

    // Ubah semua elemen text menjadi hitam
    navElements.forEach((el) => {
      el.classList.remove('text-white');
      el.classList.add('text-gray-900');
    });
  } else {
    navbar.classList.add('bg-transparent');
    navbar.classList.remove('bg-white', 'shadow-md');

    // Kembalikan warna putih
    navElements.forEach((el) => {
      el.classList.add('text-white');
      el.classList.remove('text-gray-900');
    });
  }
});

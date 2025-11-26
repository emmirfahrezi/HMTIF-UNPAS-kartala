  const navbar = document.getElementById('navbar');

  window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
      navbar.classList.remove("bg-transparent");
      navbar.classList.add("bg-white", "shadow-md");
      
      // ubah semua text nav jadi hitam
      document.querySelectorAll('#navbar a').forEach(el => {
        el.classList.remove("text-white");
        el.classList.add("text-gray-900");
      });

    } else {
      navbar.classList.add("bg-transparent");
      navbar.classList.remove("bg-white", "shadow-md");
      
      // balik lagi jadi putih
      document.querySelectorAll('#navbar a').forEach(el => {
        el.classList.add("text-white");
        el.classList.remove("text-gray-900");
      });
    }
  });

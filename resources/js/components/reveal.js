export function initReveal() {
  const reveals = document.querySelectorAll('.reveal');

  if (!reveals.length) {
    return;
  }

  if (!('IntersectionObserver' in window)) {
    reveals.forEach((reveal) => reveal.classList.add('active'));
    return;
  }

  const observerOptions = {
    root: null,
    rootMargin: '0px 0px -8% 0px',
    threshold: 0.08, // Trigger sedikit lebih awal saat elemen masuk viewport
  };

  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('active');
        revealObserver.unobserve(entry.target);
      }
    });
  }, observerOptions);

  reveals.forEach((reveal) => {
    revealObserver.observe(reveal);
  });
}

AOS.init({ duration: 700, once: true, offset: 60 });

const marcarLinkAtivo = () => {
    const links = document.querySelectorAll('.navbar .nav-link');
    const paginaAtual = new URLSearchParams(window.location.search).get('page') || 'home';

    links.forEach(link => {
        const url = new URL(link.href, window.location.origin);
        const paginaDoLink = new URLSearchParams(url.search).get('page') || 'home';

        link.classList.toggle('active', paginaDoLink === paginaAtual);
    });
};

document.addEventListener('DOMContentLoaded', () => {
    marcarLinkAtivo();
});


function atualizarNavbarScroll() {

  if (document.body.classList.contains('pagina-produtos')) return;

  const navbar = document.querySelector('.navbar-maniva');
  if (!navbar) return;

  if (window.scrollY > 40) {
    navbar.classList.add('navbar-scrolled');
  } else {
    navbar.classList.remove('navbar-scrolled');
  }
}
window.addEventListener('scroll', atualizarNavbarScroll);
document.addEventListener('DOMContentLoaded', atualizarNavbarScroll);
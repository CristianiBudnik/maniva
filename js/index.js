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

// Alternar formulário entre Reclamação e Elogio
function selecionarTipo(tipo) {
  const tabRec = document.getElementById('tabReclamacao');
  const tabElo = document.getElementById('tabElogio');
  const loteBox = document.getElementById('loteBox');
  const msgLabel = document.getElementById('msgLabel');
  const msgInput = document.getElementById('msgInput');
  const submitBtn = document.getElementById('submitBtn');
  const tipoInput = document.getElementById('tipoMensagem');
  const dataFab = document.getElementById('dataFabricacao');
  const numLote = document.getElementById('numeroLote');

  if (!tabRec || !tabElo) return;

  if (tipo === 'elogio') {
    tabRec.className = 'tab-btn inactive';
    tabElo.className = 'tab-btn active-green';
    if (loteBox) loteBox.style.display = 'none';
    if (msgLabel) msgLabel.textContent = 'Descreva o elogio ou mensagem *';
    if (msgInput) msgInput.placeholder = 'Conte-nos sua experiência...';
    if (submitBtn) {
      submitBtn.textContent = 'Enviar Elogio';
      submitBtn.className = 'btn-enviar btn-enviar-elogio';
    }
    if (tipoInput) tipoInput.value = 'elogio';
    if (dataFab) dataFab.required = false;
    if (numLote) numLote.required = false;
  } else {
    tabRec.className = 'tab-btn active-red';
    tabElo.className = 'tab-btn inactive';
    if (loteBox) loteBox.style.display = '';
    if (msgLabel) msgLabel.textContent = 'Descreva a reclamação *';
    if (msgInput) msgInput.placeholder = 'Descreva o problema...';
    if (submitBtn) {
      submitBtn.textContent = 'Enviar Reclamação';
      submitBtn.className = 'btn-enviar';
    }
    if (tipoInput) tipoInput.value = 'reclamacao';
    if (dataFab) dataFab.required = true;
    if (numLote) numLote.required = true;
  }
}
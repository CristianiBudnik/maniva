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

const vendedorPorRegiao = {
  sul: {
    vendedor: "Marcos (PR, SC, RS)",
    whatsapp: "5541999999999", // Coloque o número real com DDI + DDD
    mensagem: "Oi, gostaria de informações sobre os produtos da Maniva."
  },
  centroOeste: {
    vendedor: "Tomaz (MT, MS, GO, DF)",
    whatsapp: "5561999999999",
    mensagem: "Oi, gostaria de informações sobre os produtos da Maniva."
  },
  norte: {
    vendedor: "Pedro (Demais Estados)",
    whatsapp: "5591999999999",
    mensagem: "Oi, gostaria de informações sobre os produtos da Maniva."
  }
};

function selecionarRegiao() {
  const seleciona = document.getElementById("regiao");
  const regiao = seleciona ? seleciona.value : "";
  const dadosVendas = document.getElementById("dadosVendas");

  if (!dadosVendas) return;

  if (!regiao) {
    dadosVendas.innerHTML = "";
    return;
  }

  let vendas;

  if (["PR", "SC", "RS"].includes(regiao)) {
    vendas = vendedorPorRegiao.sul;
  } else if (["MT", "MS", "GO", "DF"].includes(regiao)) {
    vendas = vendedorPorRegiao.centroOeste;
  } else {
    vendas = vendedorPorRegiao.norte;
  }

  const linksWhatsapp = `https://wa.me/${vendas.whatsapp}?text=${encodeURIComponent(vendas.mensagem)}`;
  
  dadosVendas.innerHTML = `
    <p class="mb-2"><strong>${vendas.vendedor}</strong></p>
    <a href="${linksWhatsapp}" target="_blank" class="text-decoration-none">
      <button type="button" class="btn-maniva btn-maniva-black" style="max-width: 210px;">
        Conversar no WhatsApp
      </button>
    </a>
  `;
}

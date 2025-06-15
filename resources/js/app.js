// resources/js/app.js

import "./bootstrap";
import "./echo";

import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

import 'swiper/swiper-bundle.css';
import Swiper from 'swiper/bundle';

// Lógica para o botão de copiar URL
document.addEventListener('DOMContentLoaded', () => {
  const buttonCopy = document.querySelector('#copy');
  if (buttonCopy) {
    buttonCopy.addEventListener('click', (e) => {
      const input = document.querySelector('#share-input');
      input.select();
      document.execCommand('copy');

      buttonCopy.innerText = 'Copiado!';
      setTimeout(() => {
        buttonCopy.innerText = 'Copiar';
      }, 2000);
    });
  }
});

// Funções e lógica do modal de convite
function closeModal() {
  const inviteModal = document.getElementById('invite_modal');
  if (inviteModal) {
    inviteModal.style.display = 'none';
  }
}

function openInviteModal() {
  const inviteModal = document.getElementById('invite_modal');
  if (inviteModal) {
    inviteModal.style.display = 'flex';
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const inviteForm = document.getElementById('invite_form');
  if (inviteForm) {
    inviteForm.addEventListener('submit', function(e) {
      e.preventDefault();

      const formData = new FormData(this);
      const actionUrl = inviteForm.getAttribute('data-action') || '/campaign/invite';

      fetch(actionUrl, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          alert(data.message);
          closeModal();
        })
        .catch(error => {
          console.error('Erro:', error);
          alert('Ocorreu um erro ao enviar o convite. Tente novamente.');
        });
    });
  }
});

window.closeModal = closeModal;
window.openInviteModal = openInviteModal;

// Inicialização do Swiper (com breakpoints para cards menores e alinhados)
document.addEventListener('DOMContentLoaded', function () {
  if (document.querySelector('.mySwiper')) {
    const swiper = new Swiper('.mySwiper', {
      spaceBetween: 20,
      loop: false,
      centeredSlides: false, // Garante que os slides não fiquem centralizados

      // Adiciona um offset antes do primeiro slide para alinhar com o padding da página (p-5 = 20px)
      slidesOffsetBefore: 20,

      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },

      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

      breakpoints: {
        // Mobile (0px e acima)
        0: {
          slidesPerView: 1.2, // Mostra 1 card completo e um pedaço do próximo
          spaceBetween: 15,
          slidesOffsetBefore: 20,
        },
        // Pequenas telas (ex: tablets pequenos, 640px e acima)
        640: {
          slidesPerView: 2.5, // Mostra 2.5 cards
          spaceBetween: 20,
          slidesOffsetBefore: 20,
        },
        // Tablets e desktops menores (768px e acima)
        768: {
          slidesPerView: 3.5, // Mostra 3.5 cards
          spaceBetween: 25,
          slidesOffsetBefore: 20,
        },
        // Desktops médios (992px e acima)
        992: {
          slidesPerView: 4.5, // Mostra 4.5 cards
          spaceBetween: 30,
          slidesOffsetBefore: 20,
        },
        // Desktops maiores (1200px e acima)
        1200: {
          slidesPerView: 5.5, // Mostra 5.5 cards
          spaceBetween: 30,
          slidesOffsetBefore: 20,
        },
      },
    });
  }
});
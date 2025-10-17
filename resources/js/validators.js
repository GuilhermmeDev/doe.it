// Funções e lógica do modal de convite
function closeModal() {
    const inviteModal = document.getElementById("invite_modal");
    if (inviteModal) {
        inviteModal.style.display = "none";
    }
}

function openInviteModal() {
    const inviteModal = document.getElementById("invite_modal");
    if (inviteModal) {
        inviteModal.style.display = "flex";
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const inviteForm = document.getElementById("invite_form");
    if (inviteForm) {
        inviteForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const actionUrl =
                inviteForm.getAttribute("data-action") || "/campaign/invite";

            fetch(actionUrl, {
                method: "POST",
                headers: {
                    // Só adiciona o header se o meta existir
                    ...(document.querySelector('meta[name="csrf-token"]')
                        ? {
                              "X-CSRF-TOKEN": document.querySelector(
                                  'meta[name="csrf-token"]'
                              ).content,
                          }
                        : {}),
                },
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    alert(data.message);
                    closeModal();
                })
                .catch((error) => {
                    console.error("Erro:", error);
                    alert(
                        "Ocorreu um erro ao enviar o convite. Tente novamente."
                    );
                });
        });
    }

    const buttonCopy = document.querySelector("#copy");
    if (buttonCopy) {
        buttonCopy.addEventListener("click", (e) => {
            const input = document.querySelector("#share-input");
            input.select();
            document.execCommand("copy");

            buttonCopy.innerText = "Copiado!";
            setTimeout(() => {
                buttonCopy.innerText = "Copiar";
            }, 2000);
        });
    }
});

window.closeModal = closeModal;
window.openInviteModal = openInviteModal;

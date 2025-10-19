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
                    ...(document.querySelector('meta[name="csrf-token"]')
                        ? {
                              "X-CSRF-TOKEN": document.querySelector(
                                  'meta[name="csrf-token"]'
                              ).content,
                          }
                        : {}),
                    "Accept": "application/json",
                },
                body: formData,
            })
                .then((response) => {
                    const isSuccess = response.ok;

                    return response.json().then((data) => ({
                        ok: isSuccess,
                        data: data,
                    }));
                })
                .then((result) => {
                    alert(result.data.message);

                    if (result.ok) {
                        closeModal();
                    }
                })
                .catch((error) => {
                    
                    console.error("Erro:", error);
                    alert(
                        "Ocorreu um erro de comunicação. A resposta não pôde ser processada."
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

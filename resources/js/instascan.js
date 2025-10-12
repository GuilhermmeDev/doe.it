// Instascan QR Code Scanner Initialization for Laravel
document.addEventListener('DOMContentLoaded', async () => {
  // Verifica se Instascan está disponível
  if (typeof Instascan === 'undefined') {
    console.error('Instascan não está carregado. Certifique-se de importar o script corretamente.');
    return;
  }

  // Seleciona o elemento <video> para preview
  const videoElement = document.getElementById('preview');
  if (!videoElement) {
    console.error("Elemento <video id='preview'> não encontrado na página.");
    return;
  }

  // Inicializa o scanner Instascan
  const scanner = new Instascan.Scanner({
    video: videoElement,
    mirror: false // Não espelhar a imagem da câmera
  });

  // Adiciona listener para capturar QR codes
  scanner.addListener('scan', (content) => {
    // Exibe o conteúdo do QR code em um alert para teste
    alert(`QR Code detectado: ${content}`);
  });

  try {
    // Obtém lista de câmeras disponíveis
    const cameras = await Instascan.Camera.getCameras();
    if (cameras.length === 0) {
      // Nenhuma câmera encontrada
      console.error('Nenhuma câmera foi encontrada.');
      return;
    }

    // Tenta encontrar a câmera traseira (back)
    let selectedCamera = cameras.find(cam => cam.name && cam.name.toLowerCase().includes('back'));
    if (!selectedCamera) {
      // Fallback: usa a primeira câmera disponível
      selectedCamera = cameras[0];
      console.warn('Câmera traseira não encontrada, usando a primeira câmera disponível.');
    }

    // Inicia o scanner com a câmera selecionada
    await scanner.start(selectedCamera);
  } catch (err) {
    // Erro de permissão ou outro erro
    console.error('Erro ao acessar a câmera:', err);
  }
});

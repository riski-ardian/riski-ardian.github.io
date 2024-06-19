// Fungsi untuk menghilangkan alert dengan transisi
document.addEventListener('DOMContentLoaded', (event) => {
  var alertBox = document.getElementById('alertBox');
  if (alertBox) {
      // Set CSS transition secara langsung melalui JavaScript
      alertBox.style.transition = 'opacity 1s ease-out';
      
      setTimeout(() => {
          alertBox.style.opacity = '0';
      }, 3000); // 3000 milidetik = 3 detik

      // Menyembunyikan elemen setelah transisi selesai
      alertBox.addEventListener('transitionend', () => {
          alertBox.style.display = 'none';
      });
  }
});
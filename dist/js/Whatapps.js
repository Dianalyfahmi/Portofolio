document.getElementById("contactForm").addEventListener("submit", function (e) {
    e.preventDefault();
  
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const message = document.getElementById("message").value;
  
    // Nomor WhatsApp tujuan (gunakan format internasional tanpa + atau 0 di depan)
    const phoneNumber = "6282321302774"; // Ganti dengan nomor Anda
  
    // Format pesan
    const whatsappMessage = `Halo, Saya ${name} (${email}), ingin menyampaikan pesan berikut:\n\n${message}`;
  
    // Redirect ke WhatsApp
    const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(whatsappMessage)}`;
    window.open(whatsappURL, "_blank");
  });
  
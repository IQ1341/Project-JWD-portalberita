// bagian alert hapus
function confirmDelete(id) {
    if (confirm("Apakah Anda yakin ingin menghapus kegiatan ini?")) {
      window.location.href = "proses_hapus_kegiatan.php?id=" + id;
    }
  }

// bagian clik tambah
function openModal() {
    document.getElementById("modal").classList.remove("hidden");
  }

  function closeModal() {
    document.getElementById("modal").classList.add("hidden");
  }

// klik login
function openLoginModal() {
    document.getElementById("loginModal").classList.remove("hidden");
  }

  function closeLoginModal() {
    document.getElementById("loginModal").classList.add("hidden");
  }


 
// ===== Hamburger menu (JS-driven, menggantikan checkbox hack) =====
function initNavToggle() {

    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");

    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}


// ===== Konfirmasi hapus (front-end only, belum ke server) =====
function initHapusConfirm() {

    document.querySelectorAll(".btn-hapus").forEach(function (btn) {

        btn.addEventListener("click", function () {

            const row = btn.closest("tr");

            const nama = row
                ? row.querySelector("td")?.textContent
                : "data ini";

            const yakin = confirm(
                'Yakin ingin menghapus "' + nama + '"?'
            );

            if (yakin && row) {
                row.remove();
            }

        });

    });
}


// ===== Filter/pencarian tabel real-time =====
function initTableFilter() {

    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");

    if (!input || !table) return;

    const rows = table.querySelectorAll("tbody tr");

    // ===== Counter tabel =====
    const countInfo = document.createElement("p");

    countInfo.id = "table-count";
    countInfo.className = "table-count";

    table.parentElement.insertBefore(countInfo, table);


    // ===== Fungsi pencarian dan counter =====
    function updateTable() {

        const keyword = input.value.toLowerCase();

        let jumlahTampil = 0;

        rows.forEach(function (row) {

            // Pencarian hanya kolom pertama
            const teks =
                row.querySelector("td:first-child")?.textContent.toLowerCase() || "";

            if (teks.includes(keyword)) {

                row.style.display = "";

                jumlahTampil++;

            } else {

                row.style.display = "none";

            }

        });


        const jumlahTotal = rows.length;


        // ===== Menentukan buku atau anggota =====
        if (input.placeholder.toLowerCase().includes("anggota")) {

            countInfo.textContent =
                "Menampilkan " +
                jumlahTampil +
                " dari " +
                jumlahTotal +
                " anggota";

        } else {

            countInfo.textContent =
                "Menampilkan " +
                jumlahTampil +
                " dari " +
                jumlahTotal +
                " buku";

        }

    }


    // Menjalankan pencarian ketika mengetik
    input.addEventListener("keyup", updateTable);

    // Menampilkan counter saat halaman pertama dibuka
    updateTable();

}


// ===== Menampilkan error =====
function tampilkanError(input, pesan) {

    hapusError(input);

    const span = document.createElement("span");

    span.className = "error";

    span.textContent = pesan;

    input.insertAdjacentElement("afterend", span);
}


// ===== Menghapus error =====
function hapusError(input) {

    const next = input.nextElementSibling;

    if (next && next.classList.contains("error")) {

        next.remove();

    }

}

// ===== Validasi form =====
function initValidasiForm() {

    const form = document.getElementById("form-tambah");

    if (!form) return;

    form.addEventListener("submit", function (e) {

        let valid = true;


        // ===== Daftar field yang wajib divalidasi =====
        const fieldWajib = [

            {
                selector: "[name='judul'], [name='nama']",
                pesan: "Field ini wajib diisi."
            },

            {
                selector: "[name='pengarang']",
                pesan: "Pengarang wajib diisi."
            }

        ];


        // ===== Validasi menggunakan forEach =====
        fieldWajib.forEach(function (item) {

            const input = form.querySelector(item.selector);

            if (!input) return;

            if (input.value.trim() === "") {

                tampilkanError(
                    input,
                    item.pesan
                );

                valid = false;

            } else {

                hapusError(input);

            }

        });


        // ===== Validasi tahun =====
        const tahun = form.querySelector("[name='tahun']");

        if (tahun) {

            const nilai = parseInt(tahun.value, 10);

            if (
                isNaN(nilai) ||
                nilai < 1900 ||
                nilai > 2026
            ) {

                tampilkanError(
                    tahun,
                    "Tahun harus di antara 1900-2026."
                );

                valid = false;

            } else {

                hapusError(tahun);

            }

        }


        // ===== Validasi stok =====
        const stok = form.querySelector("[name='stok']");

        if (stok) {

            const nilai = parseInt(stok.value, 10);

            if (
                isNaN(nilai) ||
                nilai < 0
            ) {

                tampilkanError(
                    stok,
                    "Stok tidak boleh negatif."
                );

                valid = false;

            } else {

                hapusError(stok);

            }

        }


        // ===== Validasi ISBN =====
        const isbn = form.querySelector("[name='isbn']");

        if (isbn && isbn.value.trim() !== "") {

            const polaISBN = /^[0-9-]+$/;

            if (!polaISBN.test(isbn.value.trim())) {

                tampilkanError(
                    isbn,
                    "ISBN hanya boleh berisi angka dan tanda hubung (-)."
                );

                valid = false;

            } else {

                hapusError(isbn);

            }

        }


        // ===== Jika tidak valid =====
        if (!valid) {

            e.preventDefault();

        }

    });

}


// ===== Menjalankan semua fungsi =====
document.addEventListener(
    "DOMContentLoaded",
    function () {

        initNavToggle();

        initHapusConfirm();

        initTableFilter();

        initValidasiForm();

    }
);
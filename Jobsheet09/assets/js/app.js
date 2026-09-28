document.addEventListener("DOMContentLoaded", function () {

    const tombolHapus =
        document.querySelectorAll(".btn-hapus");

    tombolHapus.forEach(function (tombol) {

        tombol.addEventListener("click", function (event) {

            const yakin = confirm(
                "Apakah kamu yakin ingin menghapus data ini?"
            );

            if (!yakin) {
                event.preventDefault();
            }

        });

    });

});
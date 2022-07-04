$(document).ready(function () {

    // Tangkap input yang perlu dihidden
    $(".displayhidden").hide();

    $(".kategori_nilai_change").on("change", function () {
        if ($(this).val() == 0) {
            $(".displayhidden").hide('fast');
            return 0;
        }

        $(".displayhidden").hide('fast');
        $(".displayhiddens").hide('fast');
        // Lakukan fetch
        const URL = 'http://localhost:8080/Nilai/NilaiAjax/getJadwal';

        const formData = new FormData();
        formData.append('level_id', $(this).val());

        fetch(URL, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        }).then(res => res.json())
            .then(res => {
                // Kosongkan optionnya
                $(".fillJadwal").empty();
                // Tambahkan option hasil data baru
                for (let i = 0; i < res.length; i++) {
                    $(".fillJadwal").append(new Option(res[i].nama_hari + " | " + res[i].jam_mulai + " - " + res[i].jam_berakhir, res[i].jadwal_id));
                }
                // Tampilkan input selectnya
                $(".displayhidden").show('fast');
                $(".displayhiddens").show('fast');
            });
    });
});
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mx-auto p-6 lg:p-8" id="home-content">

    <div class="mb-8 animate-fade-in-up">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
            Selamat Datang Kembali, <span class="text-green-600"><?= esc(session()->get('username')) ?>!</span>
        </h1>
        <p class="text-gray-500 mt-2">Siap menemukan wawasan baru hari ini?</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 animate-fade-in-up" style="animation-delay: 150ms;">
            <div class="flex items-center">
                <div class="p-4 bg-green-100 rounded-lg"><i class="fa-solid fa-database text-3xl text-green-600"></i></div>
                <div class="ml-4">
                    <p class="text-gray-500">Total Data Properti</p>
                    <p id="count-properti" class="text-3xl font-bold text-gray-800">0</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 animate-fade-in-up" style="animation-delay: 300ms;">
            <div class="flex items-center">
                <div class="p-4 bg-green-100 rounded-lg"><i class="fa-solid fa-tags text-3xl text-green-600"></i></div>
                <div class="ml-4">
                    <p class="text-gray-500">Total Atribut/Kriteria</p>
                    <p id="count-kriteria" class="text-3xl font-bold text-gray-800">0</p>
                </div>
            </div>
        </div>
        <a href="<?= site_url('/analisis') ?>" class="block bg-green-600 p-6 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 animate-fade-in-up" style="animation-delay: 450ms;">
            <div class="flex items-center text-white h-full">
                <div class="p-4 bg-green-500 rounded-lg"><i class="fa-solid fa-magnifying-glass-chart text-3xl"></i></div>
                <div class="ml-4">
                    <p class="font-bold text-xl">Mulai Analisis</p>
                    <p class="text-green-100 text-sm">Temukan pola sekarang</p>
                </div>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg border border-gray-200 animate-fade-in-up" style="animation-delay: 600ms;">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Distribusi Properti Berdasarkan Lokasi</h2>
            <div>
                <canvas id="lokasiChart"></canvas>
            </div>
        </div>

        <div class="space-y-6 animate-fade-in-up" style="animation-delay: 750ms;">
            <h2 class="text-xl font-bold text-gray-800">Pintasan Cepat</h2>
            <a href="<?= site_url('/dataset') ?>" class="flex items-center gap-4 bg-white p-4 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl hover:border-green-500 hover:-translate-y-1 transition-all duration-300">
                <div class="p-3 bg-green-100 rounded-lg"><i class="fa-solid fa-table text-2xl text-green-600"></i></div>
                <div>
                    <p class="font-semibold text-gray-800">Lihat & Kelola Dataset</p>
                    <p class="text-sm text-gray-500">Impor atau hapus data</p>
                </div>
            </a>
            <a href="<?= site_url('akun') ?>" class="flex items-center gap-4 bg-white p-4 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl hover:border-green-500 hover:-translate-y-1 transition-all duration-300">
                <div class="p-3 bg-green-100 rounded-lg"><i class="fa-solid fa-user-gear text-2xl text-green-600"></i></div>
                <div>
                    <p class="font-semibold text-gray-800">Pengaturan Akun</p>
                    <p class="text-sm text-gray-500">Ubah profil & password</p>
                </div>
            </a>
        </div>
    </div>
</div>

<script>
    // Fungsi animasi hitung angka (tetap sama)
    function animateValue(obj, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            obj.innerHTML = Math.floor(progress * (end - start) + start);
            if (progress < 1) window.requestAnimationFrame(step);
        };
        window.requestAnimationFrame(step);
    }

    // Eksekusi setelah halaman dimuat
    document.addEventListener("DOMContentLoaded", () => {
        // Animasi hitung
        const countProperti = document.getElementById('count-properti');
        const countKriteria = document.getElementById('count-kriteria');
        animateValue(countProperti, 0, <?= $total_properti ?>, 1500);
        animateValue(countKriteria, 0, <?= $total_kriteria ?>, 1500);

        // Inisialisasi Grafik
        const ctx = document.getElementById('lokasiChart').getContext('2d');
        const lokasiChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= $chart_labels ?>,
                datasets: [{
                    label: 'Jumlah Properti',
                    data: <?= $chart_data ?>,
                    backgroundColor: 'rgba(22, 163, 74, 0.7)', // Warna hijau dengan transparansi
                    borderColor: 'rgba(22, 163, 74, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false // Sembunyikan legenda
                    }
                }
            }
        });
    });
</script>

<?= $this->endSection(); ?>
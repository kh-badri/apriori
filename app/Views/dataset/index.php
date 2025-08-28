<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="container mx-auto p-6 lg:p-8">
    <div class="bg-white p-6 rounded-xl shadow-lg mb-8 border border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Import Dataset</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p class="font-bold">Berhasil</p>
                <p><?= session()->getFlashdata('success') ?></p>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p class="font-bold">Gagal</p>
                <p><?= session()->getFlashdata('error') ?></p>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('dataset/upload') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <label class="block mb-2 text-sm font-medium text-gray-700" for="custom_file_upload">Upload file (format .csv)</label>
            <div class="flex items-center">
                <input type="file" id="dataset_csv" name="dataset_csv" class="hidden" accept=".csv" required>
                <button type="button" id="custom_file_upload" class="px-6 py-2.5 bg-green-600 text-white font-semibold rounded-l-lg hover:bg-green-700 transition duration-300 shadow-md transform hover:-translate-y-0.5">
                    Pilih File
                </button>
                <span id="file_name_display" class="px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-r-lg flex-grow truncate">Tidak ada file dipilih</span>
                <button type="submit" class="ml-4 px-6 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Import
                </button>
            </div>
            <p class="mt-2 text-xs text-gray-500">Pastikan file CSV tidak memiliki header dan urutan kolom sudah benar.</p>
        </form>
    </div>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Dataset Properti</h1>

        <form action="<?= site_url('dataset/hapus-semua') ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus seluruh dataset? Tindakan ini tidak dapat diurungkan.');">
            <?= csrf_field() ?>
            <button type="submit" class="px-5 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-red-600 transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                Hapus Dataset
            </button>
        </form>
        </form>
    </div>
    <div class="bg-white shadow-xl rounded-xl overflow-x-auto border border-gray-200">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-green-600 text-white uppercase text-sm font-semibold">
                    <th class="py-3 px-6 text-left">No.</th>
                    <th class="py-3 px-6 text-left">Nama Properti</th>
                    <th class="py-3 px-6 text-left">Atribut / Kriteria</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <?php if (empty($properti)): ?>
                    <tr>
                        <td colspan="3" class="text-center py-10 text-gray-500">
                            Data tidak ditemukan. Silakan import dataset terlebih dahulu.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($properti as $key => $p) : ?>
                        <tr class="border-b border-gray-200 hover:bg-green-50 transition">
                            <td class="py-4 px-6 text-left whitespace-nowrap"><?= $key + 1 ?></td>
                            <td class="py-4 px-6 text-left font-medium text-gray-800"><?= esc($p['nama_properti']) ?></td>
                            <td class="py-4 px-6 text-left text-sm"><?= esc($p['kriteria_list']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Ambil elemen input file asli
    const realFileUpload = document.getElementById('dataset_csv');
    // Ambil tombol custom
    const customFileUploadButton = document.getElementById('custom_file_upload');
    // Ambil elemen untuk menampilkan nama file
    const fileNameDisplay = document.getElementById('file_name_display');

    // Ketika tombol custom diklik, picu klik pada input file asli
    customFileUploadButton.addEventListener('click', function() {
        realFileUpload.click();
    });

    // Ketika input file asli berubah (file dipilih), update teks display
    realFileUpload.addEventListener('change', function() {
        if (realFileUpload.files.length > 0) {
            fileNameDisplay.textContent = realFileUpload.files[0].name;
        } else {
            fileNameDisplay.textContent = 'Tidak ada file dipilih';
        }
    });
</script>

<?= $this->endSection(); ?>
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="container mx-auto p-6 lg:p-8">
    <div class="mb-6 pb-4 border-b">
        <h1 class="text-3xl font-bold text-gray-800">Riwayat Analisis</h1>
        <p class="text-gray-600">Berikut adalah daftar hasil analisis yang telah Anda simpan.</p>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p><?= session()->getFlashdata('success') ?></p>
        </div>
    <?php endif; ?>

    <?php if (empty($history)): ?>
        <div class="text-center py-10 bg-white rounded-lg shadow-md">
            <i class="fa-solid fa-folder-open text-4xl text-gray-400 mb-3"></i>
            <p class="text-gray-500">Belum ada riwayat analisis yang disimpan.</p>
        </div>
    <?php else: ?>
        <div class="space-y-6">
            <?php foreach ($history as $item): ?>
                <?php $rules = json_decode($item['hasil_analisis'], true); ?>
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-500">
                                    Analisis pada: <?= date('d M Y, H:i', strtotime($item['tanggal_analisis'])) ?>
                                </p>
                                <p class="text-xl font-bold text-gray-800 mt-1">
                                    Menemukan <span class="text-green-600"><?= esc($item['jumlah_aturan']) ?> Aturan</span>
                                </p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button onclick="toggleDetails(<?= $item['id'] ?>)" class="px-4 py-2 text-sm bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition">
                                    Lihat Detail
                                </button>
                                <form action="<?= site_url('history/delete/' . $item['id']) ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus history ini?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 font-semibold rounded-lg hover:bg-red-200 transition">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="text-sm text-gray-600 mt-4 pt-4 border-t">
                            Parameter:
                            <span class="font-semibold">Support:</span> <?= esc($item['min_support']) ?>% |
                            <span class="font-semibold">Confidence:</span> <?= esc($item['min_confidence']) ?>% |
                            <span class="font-semibold">Lift:</span> <?= esc($item['min_lift']) ?>
                        </div>
                    </div>

                    <div id="details-<?= $item['id'] ?>" class="hidden bg-gray-50 p-6 border-t">
                        <h3 class="font-bold mb-2">Detail Aturan Ditemukan:</h3>
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-2 px-2 text-left font-semibold">Aturan</th>
                                    <th class="py-2 px-2 text-center font-semibold">Support</th>
                                    <th class="py-2 px-2 text-center font-semibold">Confidence</th>
                                    <th class="py-2 px-2 text-center font-semibold">Lift</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rules as $rule): ?>
                                    <tr class="border-b">
                                        <td class="py-2 px-2">
                                            <b>JIKA</b> {<?= implode(', ', $rule['antecedent']) ?>} <b>MAKA</b> {<?= implode(', ', $rule['consequent']) ?>}
                                        </td>
                                        <td class="py-2 px-2 text-center"><?= number_format($rule['support'] * 100, 2) ?>%</td>
                                        <td class="py-2 px-2 text-center"><?= number_format($rule['confidence'] * 100, 2) ?>%</td>
                                        <td class="py-2 px-2 text-center font-bold"><?= number_format($rule['lift'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script>
    function toggleDetails(id) {
        const details = document.getElementById('details-' + id);
        details.classList.toggle('hidden');
    }
</script>

<?= $this->endSection(); ?>
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="container mx-auto p-6 lg:p-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Hasil Analisis Apriori</h1>
        <p class="text-gray-600">
            Aturan asosiasi ditemukan dengan parameter:
            <span class="font-semibold">Min. Support <?= esc($min_support) ?>%</span>,
            <span class="font-semibold">Min. Confidence <?= esc($min_confidence) ?>%</span> &
            <span class="font-semibold">Min. Lift <?= esc($min_lift) ?></span>.
        </p>
    </div>

    <div class="bg-white shadow-xl rounded-xl overflow-x-auto border border-gray-200">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-green-600 text-white uppercase text-sm font-semibold">
                    <th class="py-3 px-6 text-left">No.</th>
                    <th class="py-3 px-6 text-left">Aturan (Rule)</th>
                    <th class="py-3 px-6 text-center">Support</th>
                    <th class="py-3 px-6 text-center">Confidence</th>
                    <th class="py-3 px-6 text-center">Lift Ratio</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <?php if (empty($hasil)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-500">
                            Tidak ada aturan asosiasi yang ditemukan dengan parameter tersebut.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($hasil as $key => $rule) : ?>
                        <tr class="border-b border-gray-200 hover:bg-green-50 transition">
                            <td class="py-4 px-6 text-left whitespace-nowrap"><?= $key + 1 ?></td>
                            <td class="py-4 px-6 text-left">
                                <span class="font-semibold text-gray-800">JIKA</span> {<?= implode(', ', $rule['antecedent']) ?>}
                                <span class="font-semibold text-green-700">MAKA</span> {<?= implode(', ', $rule['consequent']) ?>}
                            </td>
                            <td class="py-4 px-6 text-center"><?= number_format($rule['support'] * 100, 2) ?>%</td>
                            <td class="py-4 px-6 text-center"><?= number_format($rule['confidence'] * 100, 2) ?>%</td>
                            <td class="py-4 px-6 text-center font-bold"><?= number_format($rule['lift'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-8 flex justify-end items-center gap-4">
        <form action="<?= site_url('analisis/simpan') ?>" method="post">

            <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                <i class="fa-solid fa-save mr-2"></i> Simpan Hasil
            </button>
        </form>

        <a href="<?= site_url('analisis') ?>" class="px-8 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition">
            Kembali ke Form Analisis
        </a>
    </div>
</div>

<?= $this->endSection(); ?>
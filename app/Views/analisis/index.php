<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="container mx-auto p-6 lg:p-8">
    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Analisis Apriori</h1>
        <p class="text-gray-600 mb-6">Masukkan parameter untuk menemukan aturan asosiasi pada dataset.</p>


        <form action="<?= site_url('analisis/proses') ?>" method="post">
            <?= csrf_field() ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div>
                    <label for="min_support" class="block mb-2 text-sm font-medium text-gray-700">Minimum Support (%)</label>
                    <input type="number" name="min_support" id="min_support" value="10" step="1" min="1" max="100" class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition" required>
                    <p class="mt-1 text-xs text-gray-500">Ambang batas frekuensi.</p>
                </div>

                <div>
                    <label for="min_confidence" class="block mb-2 text-sm font-medium text-gray-700">Minimum Confidence (%)</label>
                    <input type="number" name="min_confidence" id="min_confidence" value="60" step="1" min="1" max="100" class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition" required>
                    <p class="mt-1 text-xs text-gray-500">Tingkat kepercayaan aturan.</p>
                </div>

                <div>
                    <label for="min_lift" class="block mb-2 text-sm font-medium text-gray-700">Minimum Lift Ratio</label>
                    <input type="number" name="min_lift" id="min_lift" value="1.2" step="0.1" min="0" class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition" required>
                    <p class="mt-1 text-xs text-gray-500">Kekuatan hubungan ( > 1 lebih baik).</p>
                </div>
            </div>

            <div class="mt-8 text-right">
                <button type="submit" class="px-8 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Proses Analisis
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
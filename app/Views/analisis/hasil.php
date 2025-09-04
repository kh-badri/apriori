<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="container mx-auto p-6 lg:p-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Hasil Analisis Apriori</h1>
        <div class="text-gray-600 mt-2">
            <p class="mb-2">
                Aturan asosiasi ditemukan dengan parameter:
                <span class="font-semibold text-blue-600">Min. Support <?= esc($min_support) ?>%</span>,
                <span class="font-semibold text-green-600">Min. Confidence <?= esc($min_confidence) ?>%</span> &
                <span class="font-semibold text-purple-600">Min. Lift <?= esc($min_lift) ?></span>.
            </p>
            <p class="text-sm text-gray-500">
                Total Transaksi: <span class="font-semibold"><?= esc($transaction_count ?? 0) ?></span> |
                Aturan Ditemukan: <span class="font-semibold"><?= count($hasil) ?></span>
            </p>
        </div>
    </div>

    <?php if (!empty($hasil)): ?>
        <!-- Statistik Ringkas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <h3 class="text-sm font-medium text-blue-600">Total Aturan</h3>
                <p class="text-2xl font-bold text-blue-800"><?= count($hasil) ?></p>
            </div>
            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                <h3 class="text-sm font-medium text-green-600">Avg Confidence</h3>
                <p class="text-2xl font-bold text-green-800">
                    <?= number_format(array_sum(array_column($hasil, 'confidence')) / count($hasil) * 100, 2) ?>%
                </p>
            </div>
            <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                <h3 class="text-sm font-medium text-purple-600">Max Lift</h3>
                <p class="text-2xl font-bold text-purple-800">
                    <?= number_format(max(array_column($hasil, 'lift')), 2) ?>
                </p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h3 class="text-sm font-medium text-gray-600">Avg Support</h3>
                <p class="text-2xl font-bold text-gray-800">
                    <?= number_format(array_sum(array_column($hasil, 'support')) / count($hasil) * 100, 2) ?>%
                </p>
            </div>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gradient-to-r from-green-600 to-green-500 text-white">
                        <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">No.</th>
                        <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Aturan (Rule)</th>
                        <th class="py-4 px-6 text-center text-sm font-semibold uppercase tracking-wider">
                            Support
                            <div class="text-xs font-normal mt-1 opacity-90">Frekuensi</div>
                        </th>
                        <th class="py-4 px-6 text-center text-sm font-semibold uppercase tracking-wider">
                            Confidence
                            <div class="text-xs font-normal mt-1 opacity-90">Kepercayaan</div>
                        </th>
                        <th class="py-4 px-6 text-center text-sm font-semibold uppercase tracking-wider">
                            Lift Ratio
                            <div class="text-xs font-normal mt-1 opacity-90">Kekuatan</div>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php if (empty($hasil)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-12">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-500 mb-2">Tidak Ada Aturan Ditemukan</h3>
                                    <p class="text-gray-400 text-center max-w-md">
                                        Tidak ada aturan asosiasi yang memenuhi parameter minimum yang ditentukan.
                                        Coba turunkan nilai threshold atau periksa kualitas data.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($hasil as $key => $rule) : ?>
                            <tr class="border-b border-gray-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 transition-all duration-200">
                                <td class="py-4 px-6 text-left whitespace-nowrap">
                                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-full">
                                        <?= $key + 1 ?>
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-left">
                                    <div class="flex items-center space-x-2">
                                        <span class="font-semibold text-gray-800 bg-yellow-100 px-2 py-1 rounded text-xs">JIKA</span>
                                        <div class="bg-gray-100 px-3 py-1 rounded-lg">
                                            <span class="text-sm font-medium text-gray-700">
                                                {<?= implode(', ', array_map('esc', $rule['antecedent'])) ?>}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2 mt-2">
                                        <span class="font-semibold text-green-700 bg-green-100 px-2 py-1 rounded text-xs">MAKA</span>
                                        <div class="bg-green-50 px-3 py-1 rounded-lg border border-green-200">
                                            <span class="text-sm font-medium text-green-700">
                                                {<?= implode(', ', array_map('esc', $rule['consequent'])) ?>}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex flex-col items-center">
                                        <span class="text-lg font-bold text-blue-600">
                                            <?= number_format($rule['support'] * 100, 2) ?>%
                                        </span>
                                        <div class="w-16 bg-gray-200 rounded-full h-2 mt-1">
                                            <div class="bg-blue-600 h-2 rounded-full"
                                                style="width: <?= min($rule['support'] * 100 / max(array_column($hasil, 'support')) * 100, 100) ?>%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex flex-col items-center">
                                        <span class="text-lg font-bold text-green-600">
                                            <?= number_format($rule['confidence'] * 100, 2) ?>%
                                        </span>
                                        <div class="w-16 bg-gray-200 rounded-full h-2 mt-1">
                                            <div class="bg-green-600 h-2 rounded-full"
                                                style="width: <?= $rule['confidence'] * 100 ?>%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex flex-col items-center">
                                        <span class="text-lg font-bold <?= $rule['lift'] > 2 ? 'text-purple-600' : ($rule['lift'] > 1.5 ? 'text-orange-600' : 'text-gray-600') ?>">
                                            <?= number_format($rule['lift'], 2) ?>
                                        </span>
                                        <?php if ($rule['lift'] > 2): ?>
                                            <span class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded-full mt-1">
                                                Sangat Kuat
                                            </span>
                                        <?php elseif ($rule['lift'] > 1.5): ?>
                                            <span class="text-xs bg-orange-100 text-orange-700 px-2 py-1 rounded-full mt-1">
                                                Kuat
                                            </span>
                                        <?php else: ?>
                                            <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded-full mt-1">
                                                Moderat
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (!empty($hasil)): ?>
        <!-- Analisis Tambahan -->
        <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Top Rules by Lift -->
            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    Top 3 Rules by Lift
                </h3>
                <?php
                $topByLift = array_slice($hasil, 0, 3);
                foreach ($topByLift as $index => $rule):
                ?>
                    <div class="mb-3 p-3 bg-purple-50 rounded-lg border border-purple-200">
                        <div class="text-sm text-gray-700 mb-1">
                            <strong>#{<?= $index + 1 ?>}</strong>
                            {<?= implode(', ', array_map('esc', $rule['antecedent'])) ?>} →
                            {<?= implode(', ', array_map('esc', $rule['consequent'])) ?>}
                        </div>
                        <div class="text-xs text-purple-600 font-medium">
                            Lift: <?= number_format($rule['lift'], 2) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Distribution Info -->
            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Distribusi Kualitas Rules
                </h3>
                <?php
                $liftRanges = [
                    'excellent' => 0,
                    'good' => 0,
                    'fair' => 0
                ];

                foreach ($hasil as $rule) {
                    if ($rule['lift'] >= 2) {
                        $liftRanges['excellent']++;
                    } elseif ($rule['lift'] >= 1.5) {
                        $liftRanges['good']++;
                    } else {
                        $liftRanges['fair']++;
                    }
                }
                ?>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Sangat Kuat (Lift ≥ 2.0)</span>
                        <div class="flex items-center">
                            <div class="w-20 bg-gray-200 rounded-full h-2 mr-2">
                                <div class="bg-purple-600 h-2 rounded-full" style="width: <?= $liftRanges['excellent'] / count($hasil) * 100 ?>%"></div>
                            </div>
                            <span class="text-sm font-medium text-purple-600"><?= $liftRanges['excellent'] ?></span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Kuat (1.5 ≤ Lift < 2.0)</span>
                                <div class="flex items-center">
                                    <div class="w-20 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-orange-600 h-2 rounded-full" style="width: <?= $liftRanges['good'] / count($hasil) * 100 ?>%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-orange-600"><?= $liftRanges['good'] ?></span>
                                </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Moderat (1.0 ≤ Lift < 1.5)</span>
                                <div class="flex items-center">
                                    <div class="w-20 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-gray-600 h-2 rounded-full" style="width: <?= $liftRanges['fair'] / count($hasil) * 100 ?>%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-600"><?= $liftRanges['fair'] ?></span>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Action Buttons -->
    <div class="mt-8 flex flex-col sm:flex-row justify-end items-center gap-4">
        <?php if (!empty($hasil)): ?>
            <form action="<?= base_url('analisis/simpan') ?>" method="POST" class="w-full sm:w-auto">
                <?= csrf_field() ?>
                <button type="submit"
                    class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-800 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Simpan Hasil
                </button>
            </form>

            <button onclick="exportToCSV()"
                class="w-full sm:w-auto px-8 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Export CSV
            </button>
        <?php endif; ?>

        <a href="<?= site_url('analisis') ?>"
            class="w-full sm:w-auto px-8 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Form Analisis
        </a>
    </div>
</div>

<script>
    function exportToCSV() {
        const hasil = <?= json_encode($hasil) ?>;

        if (hasil.length === 0) {
            alert('Tidak ada data untuk diekspor');
            return;
        }
        let csvContent = "No,Antecedent,Consequent,Support (%),Confidence (%),Lift\n";

        hasil.forEach((rule, index) => {
            const antecedent = rule.antecedent.join('; ');
            const consequent = rule.consequent.join('; ');
            const support = (rule.support * 100).toFixed(2);
            const confidence = (rule.confidence * 100).toFixed(2);
            const lift = rule.lift.toFixed(2);

            csvContent += `${index + 1},"${antecedent}","${consequent}",${support},${confidence},${lift}\n`;
        });

        const blob = new Blob([csvContent], {
            type: 'text/csv;charset=utf-8;'
        });
        const link = document.createElement("a");
        const url = URL.createObjectURL(blob);
        link.setAttribute("href", url);
        link.setAttribute("download", `hasil_analisis_apriori_${new Date().getTime()}.csv`);
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>

<?= $this->endSection(); ?>
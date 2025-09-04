<?php

namespace App\Libraries;

class AprioriService
{
    private float $minSupport;
    private float $minConfidence;
    private float $minLift;
    private array $transactions = [];
    private array $itemLabels = [];
    private int $transactionCount = 0;

    public function run(float $minSupport, float $minConfidence, float $minLift): array
    {
        // Konversi dari persentase ke desimal
        $this->minSupport = $minSupport / 100;
        $this->minConfidence = $minConfidence / 100;
        $this->minLift = $minLift;

        $this->_loadData();

        // Validasi data yang dimuat
        if ($this->transactionCount === 0) {
            throw new \RuntimeException('Tidak ada data transaksi yang ditemukan');
        }

        $frequentItemsets = $this->_findFrequentItemsets();

        // Validasi frequent itemsets
        if (empty($frequentItemsets)) {
            return [];
        }

        $rules = $this->_generateRules($frequentItemsets);

        // Urutkan berdasarkan lift tertinggi, kemudian confidence, lalu support
        usort($rules, function ($a, $b) {
            if ($a['lift'] === $b['lift']) {
                if ($a['confidence'] === $b['confidence']) {
                    return $b['support'] <=> $a['support'];
                }
                return $b['confidence'] <=> $a['confidence'];
            }
            return $b['lift'] <=> $a['lift'];
        });

        return $rules;
    }

    private function _loadData(): void
    {
        try {
            $db = \Config\Database::connect();

            // Validasi koneksi database
            if (!$db) {
                throw new \RuntimeException('Gagal terhubung ke database');
            }

            // Query untuk mengambil data transaksi
            $query = $db->table('transaksi_properti')
                ->select('id_properti, id_kriteria')
                ->orderBy('id_properti')
                ->get();

            if (!$query) {
                throw new \RuntimeException('Gagal mengeksekusi query transaksi');
            }

            $result = $query->getResultArray();

            // Grup transaksi berdasarkan id_properti
            $tempTransactions = [];
            foreach ($result as $row) {
                $idProperti = (int)$row['id_properti'];
                $idKriteria = (int)$row['id_kriteria'];

                if (!isset($tempTransactions[$idProperti])) {
                    $tempTransactions[$idProperti] = [];
                }
                $tempTransactions[$idProperti][] = $idKriteria;
            }

            // Konversi ke array yang terindeks berurutan
            $this->transactions = array_values($tempTransactions);
            $this->transactionCount = count($this->transactions);

            // Query untuk mengambil label kriteria
            $labelsQuery = $db->table('kriteria')
                ->select('id, kategori, nilai')
                ->get();

            if (!$labelsQuery) {
                throw new \RuntimeException('Gagal mengeksekusi query kriteria');
            }

            $labelsResult = $labelsQuery->getResultArray();

            foreach ($labelsResult as $row) {
                $this->itemLabels[(int)$row['id']] = $row['kategori'] . '_' . $row['nilai'];
            }
        } catch (\Exception $e) {
            // Log error dan throw ulang
            log_message('error', 'Error loading data: ' . $e->getMessage());
            throw $e;
        }
    }

    private function _findFrequentItemsets(): array
    {
        // Hitung minimum support count
        $minSupportCount = ceil($this->minSupport * $this->transactionCount);
        $frequentItemsets = [];

        // L1: Frequent 1-itemsets
        $itemCounts = [];
        foreach ($this->transactions as $transaction) {
            foreach ($transaction as $item) {
                $itemCounts[$item] = ($itemCounts[$item] ?? 0) + 1;
            }
        }

        $L1 = [];
        foreach ($itemCounts as $item => $count) {
            if ($count >= $minSupportCount) {
                $L1[strval($item)] = $count;
            }
        }

        if (empty($L1)) {
            return [];
        }

        $frequentItemsets[1] = $L1;

        // L2, L3, ... Lk: Frequent k-itemsets
        $k = 2;
        while (isset($frequentItemsets[$k - 1]) && !empty($frequentItemsets[$k - 1])) {
            $candidates = $this->_generateCandidates(array_keys($frequentItemsets[$k - 1]), $k - 1);

            if (empty($candidates)) {
                break;
            }

            $candidateCounts = [];
            foreach ($this->transactions as $transaction) {
                foreach ($candidates as $candidate) {
                    $candidateArray = array_map('intval', explode(',', $candidate));

                    // Cek apakah semua item dalam kandidat ada dalam transaksi
                    if (count(array_intersect($candidateArray, $transaction)) === count($candidateArray)) {
                        $candidateCounts[$candidate] = ($candidateCounts[$candidate] ?? 0) + 1;
                    }
                }
            }

            $Lk = [];
            foreach ($candidateCounts as $candidate => $count) {
                if ($count >= $minSupportCount) {
                    $Lk[$candidate] = $count;
                }
            }

            if (!empty($Lk)) {
                $frequentItemsets[$k] = $Lk;
            } else {
                break;
            }
            $k++;
        }

        return $frequentItemsets;
    }

    private function _generateRules(array $frequentItemsets): array
    {
        $rules = [];
        $supportData = [];

        // Hitung support untuk semua itemset
        foreach ($frequentItemsets as $itemsets) {
            foreach ($itemsets as $itemset => $count) {
                $supportData[$itemset] = $count / $this->transactionCount;
            }
        }

        // Generate rules dari frequent itemsets dengan size >= 2
        foreach ($frequentItemsets as $k => $level) {
            if ($k < 2) continue;

            foreach (array_keys($level) as $itemsetStr) {
                $itemset = array_map('intval', explode(',', $itemsetStr));
                $subsets = $this->_getProperSubsets($itemset);

                foreach ($subsets as $antecedent) {
                    $consequent = array_values(array_diff($itemset, $antecedent));

                    if (empty($consequent)) continue;

                    // Urutkan untuk konsistensi
                    sort($antecedent);
                    sort($consequent);

                    $antecedentStr = implode(',', $antecedent);
                    $consequentStr = implode(',', $consequent);

                    // Validasi support antecedent
                    if (!isset($supportData[$antecedentStr]) || $supportData[$antecedentStr] == 0) {
                        continue;
                    }

                    // Hitung confidence
                    $confidence = $supportData[$itemsetStr] / $supportData[$antecedentStr];

                    if ($confidence >= $this->minConfidence) {
                        // Validasi support consequent untuk lift
                        if (!isset($supportData[$consequentStr]) || $supportData[$consequentStr] == 0) {
                            continue;
                        }

                        // Hitung lift
                        $lift = $supportData[$itemsetStr] / ($supportData[$antecedentStr] * $supportData[$consequentStr]);

                        if ($lift >= $this->minLift) {
                            $rules[] = [
                                'antecedent' => $this->_mapIdsToLabels($antecedent),
                                'consequent' => $this->_mapIdsToLabels($consequent),
                                'support' => $supportData[$itemsetStr],
                                'confidence' => $confidence,
                                'lift' => $lift,
                                'antecedent_ids' => $antecedent,
                                'consequent_ids' => $consequent,
                            ];
                        }
                    }
                }
            }
        }

        return $rules;
    }

    private function _generateCandidates(array $itemsets, int $length): array
    {
        $candidates = [];
        $items = array_map(function ($item) {
            return array_map('intval', explode(',', $item));
        }, $itemsets);

        $numItemsets = count($items);

        for ($i = 0; $i < $numItemsets; $i++) {
            for ($j = $i + 1; $j < $numItemsets; $j++) {
                $item1 = $items[$i];
                $item2 = $items[$j];

                sort($item1);
                sort($item2);

                // Cek apakah k-1 prefix sama
                $prefix1 = array_slice($item1, 0, $length - 1);
                $prefix2 = array_slice($item2, 0, $length - 1);

                if ($prefix1 === $prefix2) {
                    $merged = array_unique(array_merge($item1, $item2));
                    sort($merged);

                    if (count($merged) == $length + 1) {
                        // Prune step: cek apakah semua (k-1)-subset frequent
                        if ($this->_hasInfrequentSubset($merged, $itemsets, $length)) {
                            continue;
                        }

                        $candidates[] = implode(',', $merged);
                    }
                }
            }
        }

        return array_unique($candidates);
    }

    private function _hasInfrequentSubset(array $candidate, array $frequentItemsets, int $length): bool
    {
        $subsets = $this->_getSubsetsOfSize($candidate, $length);

        foreach ($subsets as $subset) {
            sort($subset);
            $subsetStr = implode(',', $subset);

            if (!in_array($subsetStr, $frequentItemsets)) {
                return true;
            }
        }

        return false;
    }

    private function _getSubsetsOfSize(array $items, int $size): array
    {
        if ($size == 0) return [[]];
        if ($size > count($items)) return [];
        if ($size == count($items)) return [$items];

        $subsets = [];
        $n = count($items);

        // Generate all combinations of size $size
        $this->_generateCombinations($items, $size, 0, [], $subsets);

        return $subsets;
    }

    private function _generateCombinations(array $items, int $size, int $start, array $current, array &$result): void
    {
        if (count($current) == $size) {
            $result[] = $current;
            return;
        }

        for ($i = $start; $i < count($items); $i++) {
            $this->_generateCombinations($items, $size, $i + 1, array_merge($current, [$items[$i]]), $result);
        }
    }

    private function _getProperSubsets(array $items): array
    {
        $subsets = [];
        $n = count($items);

        // Generate all non-empty proper subsets (exclude empty set and full set)
        for ($i = 1; $i < (1 << $n) - 1; $i++) {
            $subset = [];
            for ($j = 0; $j < $n; $j++) {
                if ($i & (1 << $j)) {
                    $subset[] = $items[$j];
                }
            }
            $subsets[] = $subset;
        }

        return $subsets;
    }

    private function _mapIdsToLabels(array $ids): array
    {
        $labels = [];
        foreach ($ids as $id) {
            $labels[] = $this->itemLabels[$id] ?? "ID_{$id}";
        }
        return $labels;
    }

    // Method tambahan untuk debugging
    public function getTransactionCount(): int
    {
        return $this->transactionCount;
    }

    public function getItemLabels(): array
    {
        return $this->itemLabels;
    }
}

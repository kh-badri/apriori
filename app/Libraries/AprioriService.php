<?php

// PERBAIKAN: Namespace harus menggunakan backslash (\) dan "App" dengan huruf besar.
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
        $this->minSupport = $minSupport / 100;
        $this->minConfidence = $minConfidence / 100;
        $this->minLift = $minLift;

        $this->_loadData();
        if ($this->transactionCount === 0) {
            return [];
        }

        $frequentItemsets = $this->_findFrequentItemsets();
        $rules = $this->_generateRules($frequentItemsets);

        usort($rules, function ($a, $b) {
            return $b['lift'] <=> $a['lift'];
        });

        return $rules;
    }

    private function _loadData(): void
    {
        $db = \Config\Database::connect();
        $query = $db->table('transaksi_properti')
            ->select('id_properti, id_kriteria')
            ->orderBy('id_properti')
            ->get()->getResultArray();

        $tempTransactions = [];
        foreach ($query as $row) {
            $tempTransactions[$row['id_properti']][] = (int)$row['id_kriteria'];
        }
        $this->transactions = array_values($tempTransactions);
        $this->transactionCount = count($this->transactions);

        $labelsQuery = $db->table('kriteria')->select('id, kategori, nilai')->get()->getResultArray();
        foreach ($labelsQuery as $row) {
            $this->itemLabels[$row['id']] = $row['kategori'] . '_' . $row['nilai'];
        }
    }

    private function _findFrequentItemsets(): array
    {
        // RUMUS MINIMUM SUPPORT (dalam bentuk jumlah transaksi)
        // Rumus: min_support_count = min_support * total_transaksi
        $minSupportCount = $this->minSupport * $this->transactionCount;
        $frequentItemsets = [];

        $itemCounts = [];
        foreach ($this->transactions as $transaction) {
            foreach ($transaction as $item) {
                $itemCounts[$item] = ($itemCounts[$item] ?? 0) + 1;
            }
        }

        $L1 = [];
        foreach ($itemCounts as $item => $count) {
            // Memfilter item berdasarkan minimum support count
            if ($count >= $minSupportCount) {
                $L1[strval($item)] = $count;
            }
        }
        $frequentItemsets[1] = $L1;

        $k = 2;
        while (isset($frequentItemsets[$k - 1]) && !empty($frequentItemsets[$k - 1])) {
            $candidates = $this->_generateCandidates(array_keys($frequentItemsets[$k - 1]), $k - 1);

            $candidateCounts = [];
            foreach ($this->transactions as $transaction) {
                foreach ($candidates as $candidate) {
                    $candidateArray = explode(',', $candidate);
                    if (count(array_intersect($candidateArray, $transaction)) === count($candidateArray)) {
                        $candidateCounts[$candidate] = ($candidateCounts[$candidate] ?? 0) + 1;
                    }
                }
            }

            $Lk = [];
            if (!empty($candidateCounts)) {
                foreach ($candidateCounts as $candidate => $count) {
                    // Memfilter kandidat berdasarkan minimum support count
                    if ($count >= $minSupportCount) {
                        $Lk[$candidate] = $count;
                    }
                }
            }

            if (!empty($Lk)) {
                $frequentItemsets[$k] = $Lk;
            }
            $k++;
        }
        return $frequentItemsets;
    }

    private function _generateRules(array $frequentItemsets): array
    {
        $rules = [];
        $supportData = [];
        foreach ($frequentItemsets as $itemsets) {
            foreach ($itemsets as $itemset => $count) {
                // PERHITUNGAN NILAI SUPPORT (dalam bentuk desimal)
                // Rumus: Support(A) = Jumlah Transaksi Mengandung A / Total Transaksi
                $supportData[$itemset] = $count / $this->transactionCount;
            }
        }

        foreach ($frequentItemsets as $k => $level) {
            if ($k < 2) continue;

            foreach (array_keys($level) as $itemsetStr) {
                $itemset = explode(',', $itemsetStr);
                $subsets = $this->_getSubsets($itemset);

                foreach ($subsets as $antecedent) {
                    $consequent = array_diff($itemset, $antecedent);
                    if (empty($consequent)) continue;

                    sort($antecedent);
                    sort($consequent);

                    $antecedentStr = implode(',', $antecedent);

                    if (!isset($supportData[$antecedentStr]) || $supportData[$antecedentStr] == 0) continue;

                    // PERHITUNGAN NILAI CONFIDENCE
                    // Rumus: Confidence(A->B) = Support(A U B) / Support(A)
                    $confidence = $supportData[$itemsetStr] / $supportData[$antecedentStr];

                    if ($confidence >= $this->minConfidence) {
                        $consequentStr = implode(',', $consequent);
                        if (!isset($supportData[$consequentStr]) || $supportData[$consequentStr] == 0) continue;

                        // PERHITUNGAN NILAI LIFT RATIO
                        // Rumus: Lift(A->B) = Support(A U B) / (Support(A) * Support(B))
                        $lift = $supportData[$itemsetStr] / ($supportData[$antecedentStr] * $supportData[$consequentStr]);

                        if ($lift >= $this->minLift) {
                            $rules[] = [
                                'antecedent' => $this->_mapIdsToLabels($antecedent),
                                'consequent' => $this->_mapIdsToLabels($consequent),
                                'support' => $supportData[$itemsetStr],
                                'confidence' => $confidence,
                                'lift' => $lift,
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
            return explode(',', $item);
        }, $itemsets);
        $numItemsets = count($items);

        for ($i = 0; $i < $numItemsets; $i++) {
            for ($j = $i + 1; $j < $numItemsets; $j++) {
                $item1 = $items[$i];
                $item2 = $items[$j];

                $prefix1 = array_slice($item1, 0, $length - 1);
                $prefix2 = array_slice($item2, 0, $length - 1);

                if ($prefix1 === $prefix2) {
                    $merged = array_unique(array_merge($item1, $item2));
                    sort($merged);

                    if (count($merged) == $length + 1) {
                        $allSubsetsFrequent = true;
                        $subsets = $this->_getSubsets($merged);
                        foreach ($subsets as $subset) {
                            if (count($subset) == $length) {
                                sort($subset);
                                if (!in_array(implode(',', $subset), $itemsets)) {
                                    $allSubsetsFrequent = false;
                                    break;
                                }
                            }
                        }
                        if ($allSubsetsFrequent) {
                            $candidates[] = implode(',', $merged);
                        }
                    }
                }
            }
        }
        return array_unique($candidates);
    }

    private function _getSubsets(array $items): array
    {
        $subsets = [[]];
        foreach ($items as $item) {
            foreach ($subsets as $subset) {
                $subsets[] = array_merge($subset, [$item]);
            }
        }
        array_shift($subsets);
        if (count($items) > 1) {
            array_pop($subsets);
        }
        return $subsets;
    }

    private function _mapIdsToLabels(array $ids): array
    {
        $labels = [];
        foreach ($ids as $id) {
            $labels[] = $this->itemLabels[$id] ?? 'Unknown';
        }
        return $labels;
    }
}

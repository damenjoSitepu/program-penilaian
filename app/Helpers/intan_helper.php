<?php

// Menghindari N+1 Problems
function arrangeDatabase($parentQuery, $columnIdentifier = 'ID', $parentData = [], $childData = [], $dataResultName = [])
{
    // Cek Column identifier angka atau bukan.
    if (is_numeric($columnIdentifier))
        throw new \Exception('Arrange Database Function: Column Identifier Must Be String Values!');

    $rawData = [];
    $collectUnique = [];



    // Dapatkan Parent id dan kelompok datanya yang berhubungan
    foreach ($parentQuery as $query) {
        $arrangeParentData = '';

        // Cek apakah column identifier name ada atau tidak di dalam database berkaitan
        if (!array_key_exists($columnIdentifier, $query))
            throw new \Exception('Column Identifier Doesn\'t Match With Our Table Data');


        for ($j = 0; $j < count($parentData); $j++) {
            $arrangeParentData .= $query[$parentData[$j]] . '|';
        }
        $finalArrangeParentData = rtrim($arrangeParentData, '|');

        array_push($collectUnique, $finalArrangeParentData);
    }

    // Filter to single level id and sorting it
    $dataUnique = array_unique($collectUnique);
    sort($dataUnique);

    // Loop
    for ($i = 0; $i < count($dataUnique); $i++) {
        $getDetailData = [];
        $getDetailData[1] = [];

        // Explode level id dengan seluruh properti singlenya yang setara
        $explodePrimaryData = explode('|', $dataUnique[$i]);

        foreach ($parentQuery as $query) {
            if ($query[$columnIdentifier] === $explodePrimaryData[0]) {
                $childDataTemporary = [];

                for ($l = 0; $l < count($childData); $l++)
                    $childDataTemporary[$childData[$l]] = $query[$childData[$l]];

                array_push(
                    $getDetailData[1],
                    $childDataTemporary
                );
            }
        }

        // Insert Header Data
        $parentDataTemporary = [];

        for ($m = 0; $m < count($parentData); $m++)
            $parentDataTemporary[$parentData[$m]] = $explodePrimaryData[$m];

        $getDetailData[0] = $parentDataTemporary;

        // Cek penamaan data result ( default: header dan body )
        $storing = [];
        if (!empty($dataResultName)) {
            for ($nameLoop = 0; $nameLoop < count($dataResultName); $nameLoop++) {
                $storing[$dataResultName[$nameLoop]] = $getDetailData[$nameLoop];
            }
            array_push($rawData, $storing);
        } else
            array_push($rawData, [
                'header'    => $getDetailData[0],
                'body'      => $getDetailData[1]
            ]);
    }

    return $rawData;
}

// Visualisasi Stars
function visualizeStars($skor_id)
{
    $starString = '';

    for ($star = 0; $star < $skor_id; $star++) {
        if ($skor_id == 1)
            $starString .= "<i class='fas fa-star text-secondary'></i>";
        elseif ($skor_id == 2)
            $starString .= "<i class='fas fa-star text-danger'></i>";
        elseif ($skor_id == 3)
            $starString .= "<i class='fas fa-star text-warning'></i>";
        elseif ($skor_id == 4)
            $starString .= "<i class='fas fa-star text-primary'></i>";
        else
            $starString .= "<i class='fas fa-star text-success'></i>";
    }

    return $starString;
}

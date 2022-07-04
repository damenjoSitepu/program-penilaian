<?php

function arrangeDatabase($parentQuery, $columnIdentifier = 'ID', $parentData = [], $childData = [],$dataResultName = [])
{
    // Cek Column identifier angka atau bukan.
    if (is_numeric($columnIdentifier))
        return "Column Identifier Must Be String Values!";

    $rawData = [];
    $collectUnique = [];

    // Dapatkan Parent id dan kelompok datanya yang berhubungan
    foreach ($parentQuery as $query) {
        $arrangeParentData = '';

        // Cek apakah column identifier name ada atau tidak di dalam database berkaitan
        if(!array_key_exists($columnIdentifier,$query))
            return "Column Identifier Doesn't Match With Our Table Data";

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

        // Explode level id dengan seluruh properti singlenya yang setara
        $explodePrimaryData = explode('|', $dataUnique[$i]);

        foreach ($parentQuery as $query) {
            if ($query[$columnIdentifier] === $explodePrimaryData[0]) {
                $childDataTemporary = [];

                for ($l = 0; $l < count($childData); $l++)
                    $childDataTemporary[$childData[$l]] = $query[$childData[$l]];

                array_push(
                    $getDetailData,
                    $childDataTemporary
                );
            }
        }

        // Insert Header Data
        $parentDataTemporary = [];

        for ($m = 0; $m < count($parentData); $m++)
            $parentDataTemporary[$parentData[$m]] = $explodePrimaryData[$m];

        // Cek penamaan data result ( default: header dan body )
        $storing = [];
        if(!empty($dataResultName))
            for($nameLoop = 0; $nameLoop < count($dataResultName); $nameLoop++)
                $storing[$dataResultName[$nameLoop]] = 


        array_push($rawData, [
            'header'        => $parentDataTemporary,
            'body'          => $getDetailData
        ]);
    }

    return $rawData;
}
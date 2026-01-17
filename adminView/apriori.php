<?php
$data_item = array(
    array("id" => 1, "item" => "AGE, COL, H^/T"),
    array("id" => 2, "item" => "severe pneumonitis, COPD, IHD"),
    array("id" => 3, "item" => "AGE, Chr:hepatitis, left severe hydronephrosis"),
    array("id" => 4, "item" => "Renal failure, CKD, H^/T, HF"),
    array("id" => 5, "item" => "UTI, RA, DM"),
    array("id" => 6, "item" => "old stroke"),
    array("id" => 7, "item" => "severe pneumonitis, COPD, IHD"),
    array("id" => 8, "item" => "PUO, DM"),
    array("id" => 9, "item" => "oldstroke, IHD, Psychosis"),
    array("id" => 10, "item" => "severe pneumonitis, COPD, IHD"),
    array("id" => 11, "item" => "old stroke,IHD"),
   array("id" => 12, "item" => "Fainting attack"),
   array("id" => 13, "item" => "AGE"),
   array("id" => 14, "item" => "DM, HF"),
   array("id" => 15, "item" => "Severe Anemia, HCC, COL"),
   array("id" => 16, "item" => "severe pneumonitis , COPD, IHD")


    
);
$minSupport =3;
$arr = [];
for ($i = 0; $i < count($data_item); $i++) {
    $ar = [];
    $val = explode(",", $data_item[$i]["item"]);
    for ($j = 0; $j < count($val); $j++) {
        $ar[] = $val[$j];
    }
    array_push($arr, $ar);
}

$frekuensi_item = frekuensiItem($arr);
$dataEliminasi = eliminasiItem($frekuensi_item, $minSupport);

// print_r($dataEliminasi);

do {
    $pasangan_item = pasanganItem($dataEliminasi);
    $frekuensi_item = FrekuensiPasanganItem($pasangan_item, $arr);
    $dataEliminasi = eliminasiItem($frekuensi_item, $minSupport);
} while ($dataEliminasi == $frekuensi_item);


function frekuensiItem($data)
{
    $arr = [];
    for ($i = 0; $i < count($data); $i++) {
        $jum = array_count_values($data[$i]);
        foreach ($jum as $key => $v) {
            if (array_key_exists($key, $arr)) {
                $arr[$key] += 1;
            } else {
                $arr[$key] = 1;
            }
        }
    }
    return $arr;
}

function eliminasiItem($data, $minSupport)
{
    $arr = [];
    foreach ($data as $key => $v) {
        if ($v >= $minSupport) {
            $arr[$key] = $v;
        }
    }
    return $arr;
}
function pasanganItem($data_filter)
{
    $n = 0;
    $arr = [];
    foreach ($data_filter as $key1 => $v1) {
        $m = 1;
        foreach ($data_filter as $key2 => $v2) {
            $str = explode("_", $key2);
            for ($i = 0; $i < count($str); $i++) {

                if (!strstr($key1, $str[$i])) {
                    if ($m > $n + 1 && count($data_filter) > $n + 1) {
                        $arr[$key1 . "_" . $str[$i]] = 0;
                    }
                }
            }
            $m++;
        }
        $n++;
    }
    return $arr;
}

function frekuensiPasanganItem($data_pasangan, $data)
{
    $arr = $data_pasangan;
    $ky = "";
    $kali = 0;
    foreach ($data_pasangan as $key1 => $k) {
        for ($i = 0; $i < count($data); $i++) {
            $kk = explode("_", $key1);
            $jm = 0;
            for ($k = 0; $k < count($kk); $k++) {

                for ($j = 0; $j < count($data[$i]); $j++) {
                    if ($data[$i][$j] == $kk[$k]) {
                        $jm += 1;
                        break;
                    }
                }
            }
            if ($jm > count($kk) - 1) {
                $arr[$key1] += 1;
            }
        }
    }
    return $arr;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apriori</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="padding:40px">
    <h3 class="text-left">Apriori Algorithm</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                  Be discovered
                </div>
                <div class="panel-footer">
                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th rowspan="2" valign="middle" class="text-center">Id</th>
                                <th colspan="5" class="text-left">Item</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < count($data_item); $i++) {
                                echo ("<tr>");
                                echo ("<td class='text-center'>" . $data_item[$i]["id"] . "</td>");
                                echo ("<td>" . $data_item[$i]["item"] . "</td>");
                                echo ("</tr>");
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                   Question?
                </div>
                <div class="panel-footer">
                     How to know the pattern or rule if one item is selected, then it is possible to choose another item?
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="" method="post">
                         Solution <button name="submit" type="submit">Click Process</button>
                    </form>
                </div>
                <?php if (isset($_POST['submit'])) { ?>
                    <div class="panel-footer">
                        <b>Iteration 1 (Calculating Initial Itemset Frequency:)</b>
                        <div class="table-responsive">
                            <table class="table table-bordered table-earning">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th width="50%">Frekuensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $frekuensi_item = frekuensiItem($arr);
                                        foreach ($frekuensi_item as $key => $val) {
                                            echo ("<tr>");
                                            echo ("<td>" . $key . "</td>");
                                            echo ("<td>" . $val . "</td>");
                                            echo ("</tr>");
                                        }
                                        ?>
                                    </tr>
                                <tbody>
                            </table>
                        </div>
                        <span style="margin-left:8px">
                        Eliminate Iteration 1 (Remove items that do not meet the minimum support value) so that they become:
                        </span>
                        <div class="table-responsive">
                            <table class="table table-bordered table-earning">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th width="50%">Frequency</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $dataEliminasi = eliminasiItem($frekuensi_item, $minSupport);
                                        foreach ($dataEliminasi as $key => $val) {
                                            echo ("<tr>");
                                            echo ("<td>" . $key . "</td>");
                                            echo ("<td>" . $val . "</td>");
                                            echo ("</tr>");
                                        }
                                        ?>
                                    </tr>
                                <tbody>
                            </table>
                        </div>
                        <?php
                        $iterasi = 2;
                        do {
                        ?>
                            <b>Iterasi <?php echo $iterasi; ?> (Menghitung Frekuensi Awal Itemset:)</b>
                            <div class="table-responsive table--no-card m-b-30">
                                <table class="table table-bordered table-earning">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th width="50%">Frequency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $pasangan_item = pasanganItem($dataEliminasi);
                                            $frekuensi_item = FrekuensiPasanganItem($pasangan_item, $arr);
                                            foreach ($frekuensi_item as $key => $val) {

                                                $ex = explode("_", $key);
                                                $item = "";
                                                $vl = "";
                                                for ($k = 0; $k < count($ex); $k++) {
                                                    if ($k !== count($ex) - 1) {
                                                        $item .= "," . $ex[$k];
                                                    } else {
                                                        $vl = $ex[$k];
                                                    }
                                                }
                                                $aturan_asosiasi[] = array("item" => substr($item, 1), "val" => $vl, "sc" => $val);
                                                echo ("<tr>");
                                                echo ("<td>" . $key . "</td>");
                                                echo ("<td>" . $val . "</td>");
                                                echo ("</tr>");
                                            }
                                            ?>
                                        </tr>
                                    <tbody>
                                </table>
                            </div>
                            <span style="margin-left:8px">
                            Iteration Elimination <?php echo $iterasi; ?> (Removing items that do not meet the minimum support value) until it becomes:
                            </span>
                            <div class="table-responsive table--no-card m-b-30">
                                <table class="table table-bordered table-earning">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th width="50%">Frequency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $dataEliminasi = eliminasiItem($frekuensi_item, $minSupport);
                                            foreach ($dataEliminasi as $key => $val) {
                                                echo ("<tr>");
                                                // for ($j = 0; $j < count($frekuensi_item[$i]); $j++) { 
                                                echo ("<td>" . $key . "</td>");
                                                echo ("<td>" . $val . "</td>");
                                                // }
                                                echo ("</tr>");
                                            }
                                            ?>
                                        </tr>
                                    <tbody>
                                </table>
                            </div>
                        <?php $iterasi++;
                        } while ($dataEliminasi == $frekuensi_item)
                        ?>
                        <b>Because there are no more frequencies to be eliminated, the iteration is stopped.</b><br>
                        <b>Hitung Support dan Confident:</b><br>
                        <?php
                        for ($i = 0; $i < count($aturan_asosiasi); $i++) {
                            $x = 0;
                            echo $i + 1 . "Nilai confident, ";
                            echo $aturan_asosiasi[$i]["item"] . " => " . $aturan_asosiasi[$i]["val"] . "=";
                            $ex = explode(",", $aturan_asosiasi[$i]["item"]);

                            for ($l = 0; $l < count($arr); $l++) {
                                $jum = 0;
                                for ($k = 0; $k < count($ex); $k++) {

                                    for ($j = 0; $j < count($arr[$l]); $j++) {
                                        if ($arr[$l][$j] == $ex[$k]) {
                                            $jum += 1;
                                        }
                                    }
                                }
                                if (count($ex) == $jum) {
                                    $x += 1;
                                }
                            }

                            $convident = (floatval($aturan_asosiasi[$i]["sc"]) / floatval($x)) * 100;
                            
                            if($convident>=70){
                            $aturan_asosiasi[$i]["c"] = number_format($convident, 2, ".", ",");
                            echo $aturan_asosiasi[$i]["sc"] . "/" . $x . "=" . number_format(floatval($aturan_asosiasi[$i]["sc"]) / floatval($x), 2, ".", ",") . "=" . number_format($convident, 0, ".", ",") . "%";
                            echo  "<br>";
                            }
                        }
                        ?>
                        <b>Based on the Apriori algorithm, the association rules that were successfully obtained are as follows: </b>
                        <br>
                        <?php
                        for ($i = 0; $i < count($aturan_asosiasi); $i++) {
                            $x = 0;
                            echo $i + 1 . ". Jika " . $aturan_asosiasi[$i]["item"] . " maka " . $aturan_asosiasi[$i]["val"] . "<br>";
                        }
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
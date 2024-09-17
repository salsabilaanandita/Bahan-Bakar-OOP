<?php
    class Shell {
        public $tipe;
        public $harga;
        public $ppn;

        public function __construct($tipe, $harga, $ppn) {
            $this->tipe = $tipe;
            $this->harga = $harga;
            $this->ppn = $ppn;
        }
    }

    class Beli extends Shell {
        public $jumlah;

        public function hitung_total() {
            $harga_dasar = $this->harga * $this->jumlah;
            // $ppn_amount = $harga_dasar * $this->ppn;
            $ppn_amount = $harga_dasar *    $this->ppn;

            $total_setelah_ppn = $harga_dasar + $ppn_amount;
            return [$harga_dasar, $ppn_amount, $total_setelah_ppn];
        }

        public function tampilkan_bukti() {
            list($total_sebelum_ppn, $ppn_amount, $total_setelah_ppn) = $this->hitung_total();
            echo "Dengan jumlah: {$this->jumlah} Liter<br>";
            echo "Anda membeli bahan bakar minyak tipe {$this->tipe}<br>";
            echo "Harga per liter: Rp. " . number_format($this->harga, 2) . "<br>";
            echo "Total sebelum PPN: Rp. " . number_format($total_sebelum_ppn, 2) . "<br>";
            echo "PPN (10%): Rp. " . number_format($ppn_amount, 2) . "<br>";
            echo "Total yang harus anda bayar Rp. " . number_format($total_setelah_ppn, 2) . "<br>";
        }
    }
?>

    <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <style>
        <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            color:#000;
            background-color: skyblue;
        }

        h1 {
            color: #000;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.2);
        }

        label, input, select {
            display: block;
            margin-bottom: 10px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid#ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.2);
        }

        input[type="submit"] {
            background: #fff;
            color: #000;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 4px;
            padding: 10px 20px;
        }

        input[type="submit"]:hover {
            background: #fff;
        }

        .summary {
            margin-top: 30px;
            border: 1px solid ;
            padding: 10px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
<body>
    <br>

    <form method="post" action="">
        <h1>Bahan Bakar</h1>
        <br>
        <label for="liter">Masukkan Jumlah Liter:</label>
        <input type="number" name="liter" id="liter" required><br><br>

        <label for="tipe_bbm">Pilih Tipe Bahan Bakar:</label>

        <select class="form-select" aria-label="Default select example" name="tipe_bbm" id="tipe_bbm" required>
        <option value="">---Pilih Bahan Bakar---</option>
            <option value="Shell Super">Shell Super</option>
            <option value="Shell V-Power">Shell V-Power</option>
            <option value="Shell V-Power Diesel">Shell V-Power Diesel</option>
            <option value="Shell V-Power Nitro">Shell V-Power Nitro</option>
</select>

        <input type="submit" name="submit" value="Beli">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $liter = floatval($_POST['liter']);
        $tipeBBM = $_POST['tipe_bbm'];

        $hargaBBM = [
            "Shell Super" => 15000.00,
            "Shell V-Power" => 16000.00,
            "Shell V-Power Diesel" => 18000.00,
            "Shell V-Power Nitro" => 16000.00
        ];

        if (array_key_exists($tipeBBM, $hargaBBM)) {
            $bbm = new Beli($tipeBBM, $hargaBBM[$tipeBBM], 0.10);
            $bbm->jumlah = $liter;

            $result = $bbm->hitung_total();

            echo '<div class="summary">';
            echo "<h2>Transaksi</h2>";
            echo "Anda membeli bahan bakar tipe {$tipeBBM}<br>";
            echo "Dengan jumlah: {$liter} Liter<br>";
            echo "Harga per liter: Rp. " . number_format($hargaBBM[$tipeBBM], 0) . "<br>";
            echo "Total sebelum PPN: Rp. " . number_format($result[0], 0) . "<br>";
            echo "PPN (10%): Rp. " . number_format($result[1], 0) . "<br>";
            echo "Total yang harus anda bayar Rp. " . number_format($result[2], 0) . "<br>";
            echo '</div>';
        } else {
            echo "Tipe bahan bakar tidak valid!";
        }
    }
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Stok Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse; /* Menghilangkan jarak antar garis tabel */
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
        <h4>Laporan Stok Barang</h4> 
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Stok Minimum</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 0; @endphp
            @foreach($products as $product)
                
                @php $no++; @endphp
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->buy_price }}</td>
                    <td>{{ $product->sell_price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->min_stock }}</td>
                </tr>
            @endforeach
            <tr>
                <td>-</td>
                <td><b>TOTAL</b></td>
                <td>-</td>
                <td>{{ $totalBuyPrice }}</td>
                <td>{{ $totalSellPrice }}</td>
                <td>{{ $totalStock }}</td>
                <td>-</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
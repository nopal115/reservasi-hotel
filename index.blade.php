
<!DOCTYPE html>
<html>
<head>
    <title>Filter Kamar</title>
</head>
<body>
    <h2>Filter & Pencarian Kamar</h2>

    <form method="GET" action="">
        <label>Tipe Kamar:</label>
        <select name="tipe">
            <option value="">-- Semua --</option>
            <option value="Standard">Standard</option>
            <option value="Deluxe">Deluxe</option>
            <option value="Suite">Suite</option>
        </select>

        <label>Harga Minimum:</label>
        <input type="number" name="min_harga">

        <label>Harga Maksimum:</label>
        <input type="number" name="max_harga">

        <button type="submit">Cari</button>
    </form>

    <h3>Hasil:</h3>
    <ul>
        @foreach($rooms as $room)
            <li>{{ $room->type }} - Rp {{ $room->price }}</li>
        @endforeach
    </ul>
</body>
</html>

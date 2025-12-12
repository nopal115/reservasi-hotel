
<!DOCTYPE html>
<html>
<head>
    <title>Reservasi Kamar</title>
</head>
<body>
    <h2>Reservasi Kamar: {{ $room->type }}</h2>

    <form method="POST" action="/reservasi">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id }}">

        <label>Check-in:</label>
        <input type="date" name="check_in" required><br><br>

        <label>Check-out:</label>
        <input type="date" name="check_out" required><br><br>

        <label>Jumlah Tamu:</label>
        <input type="number" name="guests" min="1" required><br><br>

        <button type="submit">Pesan Sekarang</button>
    </form>
</body>
</html>

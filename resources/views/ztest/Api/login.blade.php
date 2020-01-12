<html>
<head></head>
<body>
    <form action="http://localhost/upload/upload.php" method="post">
        {{ csrf_field() }} 
    Foto
    <input type="file" name="image"></br>

    NamaFoto
    <input type="text" name="name"></br>

    Slot_ID<input type="text"  name="slotid"></br>

    Gedung_ID<input type="text" name="gedungid"></br>

    </br><input type="submit" value="ocr">
    </form>
</body>
</html>
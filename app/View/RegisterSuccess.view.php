<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Başarılı</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            padding: 20px;
        }

        .success-message {
            font-size: 24px;
            color: #008000;
            margin-bottom: 20px;
        }

        .back-link {
            text-decoration: none;
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="success-message">
        Kayıt Başarıyla Tamamlandı!
    </div>
    <p>
        Hesabınız başarıyla oluşturuldu. Sayın <?php echo $username; ?>.
    </p>
</body>

</html>
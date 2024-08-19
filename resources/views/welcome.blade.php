<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - KORAMIL KAPUAS HULU</title>
    <link rel="stylesheet" href="style.css">

    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto", sans-serif;
            text-decoration: none;
            list-style-type: none;
        }

        body {
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        header {
            background-color: #364afc;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 50px;
            height: auto;
            margin-right: 10px;
        }

        header h1 {
            font-size: 24px;
            margin: 0;
        }

        header ul {
            display: flex;
            margin: 0;
        }

        header ul li {
            margin: 0 10px;
        }

        header ul li a {
            font-size: 16px;
            color: white;
            font-weight: 600;
            padding: 10px;
        }

        header input[type="button"] {
            background-color: #0018f3;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        header input[type="button"]:hover {
            background-color: #45a049;
        }

        .content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 50px;
            flex: 1;
        }

        .content .left {
            width: 60%;
        }

        .content .left h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #333;
        }

        .content .left p {
            font-size: 18px;
            line-height: 1.6;
        }

        .content .right {
            width: 35%;
            display: flex;
            justify-content: center;
        }

        .content .right img {
            width: 100%;
            max-width: 400px;
            height: auto;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 15px 0;
            text-align: center;
            width: 100%;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="container">
        <header>
            <div class="logo">
                <img src="img/Lambang_Kodam_Tanjungpura.png" alt="Logo Koramil">
                <h1>KORAMIL KAPUAS HULU</h1>
            </div>
            {{-- <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Tentang</a></li>
                <li><a href="#">Layanan</a></li>
                <li><a href="#">Kontak</a></li>
            </ul> --}}
            <input type="button" value="Login" onclick="window.location='{{ route('login') }}'">
        </header>

        <div class="content">
            <div class="left">
                <h1>SELAMAT DATANG DI WEBSITE KORAMIL KAPUAS HULU</h1>
                <p> Koramil adalah satuan tingkat kecamatan dari TNI yang bertugas menjaga stabilitas dan keamanan di
                    wilayahnya. Dengan semangat pengabdian, kami selalu hadir untuk rakyat.
                    <br><br>
                    Kami hadir di tengah masyarakat sebagai garda terdepan pertahanan dan keamanan. Bersama-sama,
                    kita wujudkan lingkungan yang aman, damai, dan sejahtera.
                </p>
            </div>
            <div class="right">
                <img src="img/download-removebg-preview.png" alt="Military Art">
            </div>
        </div>

        <footer>
            <p>&copy; 2024 Koramil Kapuas Hulu. All Rights Reserved.</p>
        </footer>
    </div>

</body>

</html>

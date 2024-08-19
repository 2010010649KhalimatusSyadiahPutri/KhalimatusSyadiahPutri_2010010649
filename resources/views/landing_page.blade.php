<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8 ">
    <meta http-equiv="X-UA-Compatible " content="IE=edge ">
    <meta name="viewport " content="width=device-width, initial-scale=1.0 ">
    <title>Landing Page</title>
    <link rel="stylesheet" href="style.css">

    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            list-style-type: none;
            font-family: "Roboto", sans-serif;
        }

        body {
            font-family: "Roboto", sans-serif;
            background-color: #ace3ec;
            color: #333;
            /* Perbaiki nilai warna */
        }

        .container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
            height: 100%;
            /* Menggunakan min-height agar kontainer setinggi layar */
        }

        .flex {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        header {
            width: 100%;
            padding: 8px;
            display: flex;
            justify-content: space-between !important;
            background-color: #98e7ff align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0.1)
                /* Menghilangkan !important */
        }

        header .logo img {
            width: 50px;
            height: auto;
            margin-right: 10px
        }

        header h1 {
            padding: top 10px;
            padding-left: 5px;
            cursor: pointer;
        }

        header ul li {
            padding: 5px 20px;
            margin: 10px;
            transition: all 0.5s;
        }

        header ul li a {
            font-size: 20px;
            color: rgba(0, 0, 0, 0.705);
            font-weight: 600;
            transition: color ease-out 0.6s;
        }

        header ul li a:hover {
            color: rgb(53, 97, 241);
        }

        header input {
            padding: 8px 20px;
            background-color: rgb(0, 140, 255);
            color: white;
            font-weight: 800;
            outline: none;
            border: none;
            margin-top: 10px;
            font-size: 17px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.7s;
        }

        header input:hover {
            transform: scale(1.09);
            background-color: rgba(0, 217, 255, 0.705);
        }

        .container .content {
            width: 100%;
            height: 80vh;
        }

        .content .left {
            width: 60%;
            padding: 0 100px;
        }

        .content .left h1 {
            font: size 50px;
        }

        .content .right {
            width: 40%;
            right: 50px;
            position: relative;
        }

        .content .right img {
            margin-top: -130px;
            width: 100%;
            left: 80;
        }

        footer {
            background-color: #008697;
            color: #fff;
            text-align: center;
            padding: 19px;
            box-shadow: 0 2px 5px rgba(0, 0, 0.1)
        }
    </style>
</head>

<body>
    <div class="container ">
        <header class="flex">

            <div class="logo flex">
                <img src="img/Lambang_Kodam_Tanjungpura (1) (1) (1).png">
                <h1>KORAMIL KAPUAS HULU</h1>
            </div>

            <ul class="flex">
                <li>
                    <a href="#"></a>
                </li>
                <li>
                    <a href="#"></a>
                </li>
                <li>
                    <a href="#"></a>
                </li>
                <li>
                    <a href="#"></a>
                </li>

            </ul>

            <input type="button" value="Login" onclick="window.location='{{ route('login') }}'">
        </header>

        <div class="content flex">
            <div class="left">
                <h1>
                    SELAMAT DATANG DI WEBSITE KORAMIL KAPUAS HULU
                </h1>
                <br>
                <br>

                <p>
                    Koramil adalah satuan tingkat kecamatan dari TNI yang langsung berhubungan dengan pejabat dan
                    masyarakat sipil. Pemimpinnya adalah Komandan Rayon Militer (Danramil).
                </p>
            </div>

            <div class="right">
                <img src="img/Military_Art_Print.png" alt="">
            </div>
        </div>

        <footer>
            <p>&copy; 2024 Koramil Kapuas Hulu.</p>
        </footer>
    </div>

</body>


</html>

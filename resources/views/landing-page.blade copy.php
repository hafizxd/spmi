<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Enzo admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Enzo admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ url('/html/assets/images/favicon/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ url('/html/assets/images/favicon/favicon.png') }}" type="image/x-icon">
    <title>SPMI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #3056D3;
            color: white;
            display: flex;
            align-items: center;
            padding: 20px;
            justify-content: space-between;
        }

        .header .logo {
            width: 100px;
            height: auto;
        }

        .header h1 {
            flex-grow: 1;
            text-align: center;
            font-size: 24px;
        }

        .header .login-btn {
            background-color: white;
            color: #3056D3;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .main-content {
            padding: 20px;
        }

        .introduction,
        .objectives,
        .specific-objectives,
        .vision-mission {
            margin-bottom: 20px;
        }

        .objectives ol,
        .specific-objectives ol,
        .mission ol {
            margin-left: 20px;
        }

        .vision-mission {
            display: flex;
            justify-content: space-between;
        }

        .vision,
        .mission {
            width: 45%;
        }

        .vision h3,
        .mission h3 {
            background-color: #E5E5E5;
            padding: 10px;
        }

        .vision p,
        .mission ol {
            padding: 10px;
            background-color: #F9F9F9;
        }
    </style>
</head>

<body>
    <header class="header">
        <img src="path_to_logo_image.png" alt="Polines Logo" class="logo">
        <h1>SISTEM PENJAMINAN MUTU INTERNAL POLINES</h1>
        <button class="login-btn">Login</button>
    </header>
    <main class="main-content">
        <section class="introduction">
            <p>SPMI adalah kegiatan sistemik penjaminan mutu pendidikan tinggi oleh setiap perguruan tinggi secara otonom atau mandiri untuk mengendalikan dan meningkatkan penyelenggaraan pendidikan tinggi secara terencana dan berkelanjutan, hal tersebut sesuai dengan Permenristekdikti Nomor 62 Tahun 2016 tentang Sistem Penjaminan Mutu Pendidikan Tinggi.</p>
        </section>
        <section class="objectives">
            <h2>Secara umum, SPMI memiliki tujuan sebagai berikut:</h2>
            <ol>
                <li>Mencapai visi, misi melalui penetapan standar mutu dengan cara perbaikan berkelanjutan (continuous improvement) menggunakan manajemen berbasis proses.</li>
                <li>Kepuasan pelanggan (customer satisfaction).</li>
                <li>Keputusan pelanggan tetap (customer care).</li>
            </ol>
        </section>
        <section class="specific-objectives">
            <h2>Secara khusus, SPMI POLINES memiliki tujuan sebagai berikut:</h2>
            <ol>
                <li>Melaksanakan pendidikan tinggi bidang teknologi dan bisnis yang unggul, berkarakter dan berorientasi kewirausahaan.</li>
                <li>Melaksanakan penelitian terapan bidang teknologi dan bisnis serta penerapan teknologi masa depan dengan kerjasama technopreneur research.</li>
                <li>Mengembangkan hubungan masyarakat cerdas berpengetahuan melalui penyasarakatan techno-science bagi kemandirian bangsa.</li>
                <li>Mewujudkan tata kelola manajemen institusi melalui perbaikan berkelanjutan berdasarkan prinsip tata kelola yang baik (good governance).</li>
            </ol>
        </section>
        <section class="vision-mission">
            <div class="vision">
                <h3>Visi</h3>
                <p>Politeknik Negeri Semarang menjadi perguruan tinggi yang menjunjung kemuliaan teknologi dan bisnis Indonesia serta berkelas dunia.</p>
            </div>
            <div class="mission">
                <h3>Misi</h3>
                <ol>
                    <li>Melaksanakan pendidikan tinggi bidang teknologi dan bisnis yang unggul, berkarakter dan berorientasi kewirausahaan.</li>
                    <li>Melaksanakan penelitian terapan bidang teknologi dan bisnis serta penerapan teknologi masa depan dengan kerjasama technopreneur research.</li>
                    <li>Mengembangkan hubungan masyarakat cerdas berpengetahuan melalui penyasarakatan techno-science bagi kemandirian bangsa.</li>
                    <li>Mewujudkan tata kelola manajemen institusi melalui perbaikan berkelanjutan berdasarkan prinsip tata kelola yang baik (good governance).</li>
                </ol>
            </div>
        </section>
    </main>

    @include('sweetalert::alert')
</body>

</html>

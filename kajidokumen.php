<?php
session_start();

include('Data.php');
include('Database.php');

if (!$_SESSION['username'] && !$_SESSION['password']) {
    header('location: login.php');
};

if ($_REQUEST['id']) {
    $_SESSION['id'] = $_REQUEST['id'];
    $_SESSION['project'] = $_REQUEST['project'];
    $_SESSION['data'] = getDataById($_REQUEST['id']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['project'] ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="./assets/logo.png">
</head>

<body class="bg-neutral-100">
    <div class="flex fixed top-0 inset-x-0 z-50 px-7 py-3 bg-white items-center justify-between">
        <div class="flex items-center space-x-10">
            <a href="dashboard.php">
                <img src="./assets/logo.png" alt="logo" class="w-10">
            </a>
            <div class="flex w-max h-max relative">
                <svg class="absolute top-0 bottom-0 m-auto ml-3" width="20" height="20" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18 9.00002C15.6131 9.00002 13.3239 9.94823 11.636 11.6361C9.94821 13.3239 9 15.6131 9 18C9 20.387 9.94821 22.6762 11.636 24.364C13.3239 26.0518 15.6131 27 18 27C20.3869 27 22.6761 26.0518 24.364 24.364C26.0518 22.6762 27 20.387 27 18C27 15.6131 26.0518 13.3239 24.364 11.6361C22.6761 9.94823 20.3869 9.00002 18 9.00002ZM4.5 18C4.49973 15.8753 5.00095 13.7806 5.96289 11.8862C6.92483 9.99175 8.32033 8.35111 10.0359 7.0977C11.7515 5.84428 13.7386 5.01349 15.8358 4.67289C17.933 4.33229 20.081 4.49149 22.105 5.13755C24.1291 5.78362 25.9721 6.89829 27.4841 8.39093C28.9962 9.88357 30.1345 11.712 30.8067 13.7276C31.4788 15.7431 31.6657 17.8888 31.3522 19.9903C31.0387 22.0917 30.2337 24.0894 29.0025 25.821L39.8408 36.6593C40.2506 37.0836 40.4774 37.652 40.4723 38.2419C40.4671 38.8319 40.2305 39.3962 39.8133 39.8134C39.3962 40.2305 38.8318 40.4672 38.2419 40.4723C37.652 40.4774 37.0836 40.2506 36.6592 39.8408L25.8233 29.0048C23.8036 30.4409 21.4275 31.2934 18.9555 31.4688C16.4835 31.6442 14.0109 31.1358 11.8087 29.9992C9.60644 28.8626 7.75954 27.1418 6.47038 25.0253C5.18121 22.9088 4.49952 20.4782 4.5 18V18Z" fill="black" />
                </svg>
                <input type="text" id="search" placeholder="            Search" class="bg-neutral-100 h-max py-2 w-[25rem] text-sm rounded-lg">
            </div>
        </div>

        <img src="./assets/profile.png" class="w-10" alt="">
    </div>

    <div class="flex w-screen">
        <nav class="px-10 fixed left-0 top-20 inset-x-0 w-max bg-white py-3 h-screen transition-all duration-500" id="navbar">
            <button onclick="hidesidebar()" id="navbartoggle" style="right: -10px;" class="w-max transition-all duration-500 h-max p-2 bg-neutral-200 rounded-md absolute shadow-sm hover:shadow-xl transition-all duration-500 text-neutral-500 hover:text-neutral-800 top-0 bottom-0 m-auto">
            </button>

            <div class="flex items-end justify-center space-x-2">
                <svg width="18" height="25" viewBox="0 0 42 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M37.3333 5.3H27.58C26.6 2.226 24.0333 0 21 0C17.9667 0 15.4 2.226 14.42 5.3H4.66667C2.1 5.3 0 7.685 0 10.6V47.7C0 50.615 2.1 53 4.66667 53H37.3333C39.9 53 42 50.615 42 47.7V10.6C42 7.685 39.9 5.3 37.3333 5.3ZM21 5.3C22.2833 5.3 23.3333 6.4925 23.3333 7.95C23.3333 9.4075 22.2833 10.6 21 10.6C19.7167 10.6 18.6667 9.4075 18.6667 7.95C18.6667 6.4925 19.7167 5.3 21 5.3ZM25.6667 42.4H9.33333V37.1H25.6667V42.4ZM32.6667 31.8H9.33333V26.5H32.6667V31.8ZM32.6667 21.2H9.33333V15.9H32.6667V21.2Z" fill="black" />
                </svg>
                <h3 class="font-semibold text-xl mb-[-2px]"><?php echo $_SESSION['project'] ?></h3>
            </div>
            <hr class="w-full mt-3">

            <h3 class="text-neutral-400 mt-5 tracking-wide">Activity</h3>
            <a href="kajidokumen.php" class="flex items-end justify-start space-x-2 mt-3 group">
                <svg width="12" height="17" viewBox="0 0 34 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M30.2222 4.3H22.3267C21.5333 1.806 19.4556 0 17 0C14.5444 0 12.4667 1.806 11.6733 4.3H3.77778C1.7 4.3 0 6.235 0 8.6V38.7C0 41.065 1.7 43 3.77778 43H30.2222C32.3 43 34 41.065 34 38.7V8.6C34 6.235 32.3 4.3 30.2222 4.3ZM17 4.3C18.0389 4.3 18.8889 5.2675 18.8889 6.45C18.8889 7.6325 18.0389 8.6 17 8.6C15.9611 8.6 15.1111 7.6325 15.1111 6.45C15.1111 5.2675 15.9611 4.3 17 4.3ZM20.7778 34.4H7.55556V30.1H20.7778V34.4ZM26.4444 25.8H7.55556V21.5H26.4444V25.8ZM26.4444 17.2H7.55556V12.9H26.4444V17.2Z" fill="#8E8E8E" />
                </svg>

                <h3 class="tracking-wide mb-[-4px] text-neutral-800 transition-all duration-500" style="cursor: pointer;">Kaji Dokumen</h3>
            </a>
            
            <a href="score.php" class="flex items-end justify-start space-x-2 mt-3 group">
                <svg width="12" height="17" viewBox="0 0 34 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M30.2222 4.3H22.3267C21.5333 1.806 19.4556 0 17 0C14.5444 0 12.4667 1.806 11.6733 4.3H3.77778C1.7 4.3 0 6.235 0 8.6V38.7C0 41.065 1.7 43 3.77778 43H30.2222C32.3 43 34 41.065 34 38.7V8.6C34 6.235 32.3 4.3 30.2222 4.3ZM17 4.3C18.0389 4.3 18.8889 5.2675 18.8889 6.45C18.8889 7.6325 18.0389 8.6 17 8.6C15.9611 8.6 15.1111 7.6325 15.1111 6.45C15.1111 5.2675 15.9611 4.3 17 4.3ZM20.7778 34.4H7.55556V30.1H20.7778V34.4ZM26.4444 25.8H7.55556V21.5H26.4444V25.8ZM26.4444 17.2H7.55556V12.9H26.4444V17.2Z" fill="#8E8E8E" />
                </svg>

                <h3 class="text-neutral-400 font-light tracking-wide mb-[-4px] group-hover:text-neutral-800 transition-all duration-500" style="cursor: pointer;">Score</h3>
            </a>
            <a href="report.php" class="flex items-end justify-start space-x-2 mt-3 group">
                <svg width="12" height="17" viewBox="0 0 34 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M30.2222 4.3H22.3267C21.5333 1.806 19.4556 0 17 0C14.5444 0 12.4667 1.806 11.6733 4.3H3.77778C1.7 4.3 0 6.235 0 8.6V38.7C0 41.065 1.7 43 3.77778 43H30.2222C32.3 43 34 41.065 34 38.7V8.6C34 6.235 32.3 4.3 30.2222 4.3ZM17 4.3C18.0389 4.3 18.8889 5.2675 18.8889 6.45C18.8889 7.6325 18.0389 8.6 17 8.6C15.9611 8.6 15.1111 7.6325 15.1111 6.45C15.1111 5.2675 15.9611 4.3 17 4.3ZM20.7778 34.4H7.55556V30.1H20.7778V34.4ZM26.4444 25.8H7.55556V21.5H26.4444V25.8ZM26.4444 17.2H7.55556V12.9H26.4444V17.2Z" fill="#8E8E8E" />
                </svg>

                <h3 class="text-neutral-400 font-light tracking-wide mb-[-4px] group-hover:text-neutral-800 transition-all duration-500" style="cursor: pointer;">Report</h3>
            </a>
        </nav>


        <div class="mt-28 transition-all duration-500" style="margin-left:13rem;" id="table">

            <table class="table-auto m-10 rounded-lg overflow-hidden w-[120rem]">
                <thead>
                <tr>
                        <th rowspan="2" class="px-2 py-2 bg-blue-900 text-center text-xs w-[8rem] font-semibold text-white uppercase tracking-wider">Parameter</th>
                        <th rowspan="2" class="px-2 py-2 bg-blue-400 text-center text-xs w-[8rem] font-semibold text-gray-700 uppercase tracking-wider">Kutipan dan Bukti Penting</th>
                        <th rowspan="2" class="px-2 py-2 bg-blue-400 text-center text-xs w-[8rem] font-semibold text-gray-700 uppercase tracking-wider">Temuan/Gap Utama</th>
                        <th rowspan="2" class="px-2 py-2 bg-blue-400 text-center text-xs w-[8rem] font-semibold text-gray-700 uppercase tracking-wider">Sumber Data/Referensi</th>
                        <th rowspan="2" class="px-4 py-2 bg-blue-400 text-center text-xs w-[6rem] font-semibold text-gray-700 uppercase tracking-wider">Nilai</th>
                    
                        <th colspan="5" class="px-2 py-2 border border-blue-500 bg-blue-900 text-center text-xs font-semibold text-white uppercase tracking-wider">Kriteria Parameter Ukur</th>
                    </tr>
                    <th class="px-3 py-3 w-[10rem] bg-blue-900 text-center text-xs font-semibold text-white uppercase tracking-wider">
                        Fase praktik terbaik</th>
                    <th class="px-3 py-3 w-[10rem] bg-blue-900 text-center text-xs font-semibold text-white uppercase tracking-wider">
                        Fase praktik yang lebih baik</th>
                    <th class="px-3 py-3 w-[10rem] bg-blue-900 text-center text-xs font-semibold text-white uppercase tracking-wider">
                        Fase praktik yang baik</th>
                    <th class="px-3 py-3 w-[10rem] bg-blue-900 text-center text-xs font-semibold text-white uppercase tracking-wider">
                        Fase berkembang</th>
                    <th class="px-3 py-3 w-[10rem] bg-blue-900 text-center text-xs font-semibold text-white uppercase tracking-wider">
                        Fase awal</th>
                    </tr>
                    <tr>
                        <th colspan="10" class="px-3 py-1 bg-orange-300 text-left text-[10px] font-semibold text-gray-700 uppercase tracking-wider">
                            Dimensi Budaya dan Kapabilitas Resiko</th>
                    </tr>
                    <tr>
                        <th colspan="10" class="px-3 py-1 bg-orange-300 text-left text-[10px] font-semibold text-gray-700 uppercase tracking-wider">
                            Sub Dimensi 1. Budaya Risiko</th>
                    </tr>
                </thead>

                <tbody>
                    <!--SUBDIMENSI 1-->
                    <div>
                        <tr>
                            <td rowspan="18" class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                1. Internalisasi budaya Risiko dalam budaya perusahaan
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 0, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Telah ada program penanaman budaya risiko yang sedang dijalankan (misal risk awards, kampanye, risk townhall, dan sebagainya) dan terdapat program sadar risiko, saat ini dilakukan secara rutin dan lebih sering (lebih dari satu kali dalam setahun),
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Telah ada program penanaman budaya risiko yang sedang dijalankan (misal risk awards, kampanye, risk townhall, dan sebagainya) dan terdapat program sadar risiko, saat ini dilakukan secara rutin dan lebih sering (lebih dari satu kali dalam setahun)
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Telah ada program penanaman budaya risiko yang sedang dijalankan (misal risk awards, kampanye, risk townhall, dan sebagainya) dan terdapat program sadar risiko, saat ini dilakukan secara rutin (sekurang kurangnya satu kali dalam setahun). </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Telah ada program penanaman budaya risiko (misal risk awards, kampanye, risk townhall, dan sebagainya), namun saat ini dilakukan secara ad-hoc
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top align-top">
                                Belum ada program penanaman budaya risiko, namun telah disusun peta jalan/rencana implementasi program penanaman budaya risiko (misal risk awards, kampanye, risk townhall, dan sebagainya)
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 1, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Telah ada evaluasi terhadap peningkatan budaya risiko (misal survei budaya risiko) termasuk mengumpulkan masukan dari pegawai untuk pengembangan program budaya risiko
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Telah ada evaluasi terhadap peningkatan budaya risiko (misal survei budaya risiko) termasuk mengumpulkan masukan dari pegawai untuk pengembangan program budaya risiko
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 2, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Tanggung jawab pengembangan budaya risiko secara jelas diemban dan tercantum pada peran dan tanggung jawab jabatan tidak hanya untuk organ pengelola risiko (misal Komisaris, Direktur Utama, staf Manajemen Risiko), tetapi juga untuk pegawai di Tiga Lini Pertahanan (khususnya yang memegang posisi manajerial) </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Tanggung jawab pengembangan budaya risiko secara jelas diemban oleh organ pengelola risiko (misal Komisaris, Direktur Utama, staf Manajemen Risiko) dan tercantum pada peran dan tanggung jawab jabatan tersebut. </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Tanggung jawab pengembangan budaya risiko secara jelas diemban oleh organ pengelola risiko (misal Komisaris, Direktur Utama, staf Manajemen Risiko) dan tercantum pada peran dan tanggung jawab jabatan tersebut.
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Tanggung jawab pengembangan budaya risiko secara tidak langsung diemban oleh organ pengelola risiko (misal Komisaris, Direktur Utama, staf Manajemen Risiko) namun tidak tercantum dengan jelas pada peran dan tanggung jawab jabatan tersebut
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 3, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Balance scorecard antara Risiko dan Unit Bisnis saling berkaitan (Bisnis memiliki KPI risiko, dan Risiko memiliki KPI bisnis); hal-hal yang berkaitan dengan budaya risiko diperhitungkan dalam proses kepegawaian (misal perekrutan, promosi, dan keputusan evaluasi/insentif)
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Balance scorecard antara Risiko dan Unit Bisnis saling berkaitan (Bisnis memiliki KPI risiko, dan Risiko memiliki KPI bisnis)
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Balance scorecard antara Risiko dan Unit Bisnis sebagian saling berkaitan, contohnya Bisnis memiliki KPI risiko, namun Risiko tidak memiliki KPI bisnis ATAU Risiko memiliki KPI bisnis, namun Bisnis tidak memiliki KPI risiko
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Balance scorecard antara Risiko dan Unit Bisnis tidak berkaitan (Risiko tidak memiliki KPI bisnis, dan Bisnis tidak memiliki KPI risiko)
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 4, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Program penanaman budaya risiko saat ini berjalan efektif, terbukti dari kenaikan skor kematangan risiko (misal kenaikan di Dimensi budaya risiko)
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Program penanaman budaya risiko saat ini berjalan efektif, terbukti dari kenaikan skor kematangan risiko (misal kenaikan di Dimensi budaya risiko)
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 5, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Budaya risiko menjadi bagian integral dari budaya perusahaan (“ini cara kerja kami”). Budaya risiko tercantum pada kebijakan budaya kerja yang disosialisasikan di perusahaan, dan budaya ini tertanam di seluruh lini perusahaan dimulai dengan penegasan dari jajaran manajemen, diperkuat dengan langkah nyata (yang juga dapat digunakan sebagai kriteria evaluasi kinerja pegawai): </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Budaya risiko belum tertanam di kegiatan usaha sehari-hari (misal kepemilikan dan tanggung jawab risiko pegawai dan jajaran manajemen belum jelas). Tanggung jawab pengembangan budaya risiko secara tidak langsung diemban oleh unit kerja khusus (misal divisi pengembangan budaya Perusahaan, divisi SDM) namun keterlibatan organ pengelola risiko (misal Komisaris, Direktur Utama, staf Manajemen Risiko) masih rendah
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 6, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                a. Cepat mengantisipasi potensi risiko dan menanggapinya dengan tepat
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 7, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                b. Menyeimbangkan target jangka pendek dan risiko jangka panjang
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 8, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                c. Rutin mengadakan pembahasan risiko saat diperlukan, bahkan jika pembahasannya dianggap sulit
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 9, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                d. Mendukung pelaksanaan inisiatif Manajemen Risiko dan secara ketat menerapkan pedoman Manajemen Risiko
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 10, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                e. Resiliensi (contohnya resiliensi operasional, tanggap merespons peristiwa yang merugikan, dan sebagainya, dengan memberi penekanan baik dalam penyusunan strategi maupun dalam pelaksanaannya)
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 11, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Telah ada serangkaian sistem penunjang untuk pelaksanaan dan penanaman program budaya risiko perusahaan, contohnya:
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 12, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                a. o Intranet perusahaan untuk memuat informasi yang dapat diakses mengenai program budaya risiko dan kebijakan risiko perusahaan
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 13, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                b. o Tersedia dashboard untuk memantau metrik yang berkaitan dengan budaya risiko/program budaya risiko
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 14, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                Telah ada bukti yang jelas atas kinerja implementasi program budaya risiko, di antaranya:
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 15, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                a. Bukti perbaikan indikator utama berkaitan dengan budaya risiko perusahaan, di antaranya penurunan jumlah kasus kecurangan internal, korupsi, dan pelanggaran kode etika pegawai, beserta penurunan jumlah kerugian dari kasus pelanggaran tersebut
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 16, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                b. Penyelesaian penuh program budaya risiko bagi pegawai yang telah direncanakan dalam periode pelaporan
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                                <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub1', 'a', 17, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                BUMN dengan skor maturitas pada parameter ini telah menerapkan tata kelola risiko yang dapat berpengaruh pada tercapainya kinerja keuangan & non-keuangan yang bersumber dari operasional BUMN yaitu >110% dari target RKAP
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                BUMN dengan skor maturitas pada parameter ini telah menerapkan tata kelola risiko yang dapat berpengaruh pada tercapainya kinerja keuangan & non-keuangan yang bersumber dari operasional BUMN yaitu 105-110% dari target RKAP
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                BUMN dengan skor maturitas pada parameter ini telah menerapkan tata kelola risiko yang dapat berpengaruh tercapainya kinerja keuangan & non keuangan yang bersumber dari operasional BUMN yaitu 100-105% dari target RKAP
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                                BUMN dengan skor maturitas pada parameter ini belum optimal dalam menerapkan tata kelola risiko yang dapat berpengaruh pada tidak tercapainya kinerja keuangan & non-keuangan yang bersumber dari operasional BUMN sesuai target RKAP
                            </td>
                            <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                            </td>
                        </tr>
                    </div>

                    <!--SUBDIMENSI 2-->
                    <tr>
                        <th colspan="10" class="px-3 py-1 bg-orange-300 text-left text-[10px] font-semibold text-gray-700 uppercase tracking-wider">
                            Sub Dimensi 2. Kapabilitas Risiko</th>
                    <tr>
                        <td rowspan="12" class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            2. Peran Penilaian RMI dalam upaya peningkatan praktik Manajemen Risiko
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'a', 0, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada penilaian Indeks Kematangan Risiko yang telah diformalisasikan ke dalam kebijakan risiko perusahaan
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada penilaian Indeks Kematangan Risiko yang telah diformalisasikan ke dalam kebijakan risiko perusahaan
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada penilaian Indeks Kematangan Risiko
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada penilaian Indeks Kematangan Risiko setidaknya dalam 3 tahun terakhir
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top align-top">
                            Belum ada penilaian Indeks Kematangan Risiko yang dilakukan secara formal, Namun, evaluasi kematangan manajemen risiko pernah dilakukan secara informal/ad-hoc oleh manajemen (misal taskforce/unit kerja khusus)
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'a', 1, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Penilaian dilakukan secara rutin (setiap tahun) dan telah dilaksanakan dengan baik di level Holding dan setiap anak perusahaan (jika relevan)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Penilaian dilakukan secara rutin (setiap tahun), dan telah dilaksanakan dengan baik di level Holding dan setiap anak perusahaan (jika relevan)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Penilaian dilakukan secara rutin (setiap tahun), setidaknya dilaksanakan untuk level Holding
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Penilaian tidak dilakukan dengan periode yang sistematis (yaitu dilakukan secara ad-hoc)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'a', 2, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Penilaian mencakup seluruh Dimensi utama risiko (misal budaya risiko, tata kelola risiko, kerangka Enterprise Risk Management, kepatuhan risiko, proses dan kontrol risiko, dan teknologi risiko)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Penilaian mencakup seluruh Dimensi utama risiko (misal budaya risiko, tata kelola risiko, kerangka Enterprise Risk Management, kepatuhan risiko, proses dan kontrol risiko, dan teknologi risiko)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Penilaian mencakup seluruh Dimensi utama risiko (misal budaya risiko, tata kelola risiko, kerangka Enterprise Risk Management, kepatuhan risiko, proses dan kontrol risiko, dan teknologi risiko)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Penilaian belum mencakup semua Dimensi risiko (misal budaya risiko, tata kelola risiko, kerangka Enterprise Risk Management, kepatuhan risiko, proses dan kontrol risiko, serta teknologi risiko)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Penilaian masih bersifat high-level, kajian mendalam belum dilaksanakan
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'a', 3, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada rencana perbaikan berdasarkan hasil penilaian tingkat kematangan risiko dengan tindak lanjut yang jelas (terdapat inisiatif mendetail dengan penanggung jawab, tata waktu implementasi terperinci)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada rencana perbaikan berdasarkan hasil penilaian tingkat kematangan risiko dengan tindak lanjut yang jelas (terdapat inisiatif mendetail dengan penanggung jawab, tata waktu implementasi terperinci)

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada rencana perbaikan berdasarkan hasil penilaian tingkat kematangan risiko, namun langkah tindak lanjut belum jelas (rencana masih bersifat umum, pemilik inisiatif belum ditunjuk, tata waktu belum didetailkan)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'a', 4, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Metode penilaian risiko diperbarui secara periodik untuk mengimplementasikan praktik terbaik terkini (tidak ada budaya 'cepat merasa puas')
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'a', 5, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada pemantauan progres implementasi rencana perbaikan, milestone/bukti dokumentasi penting tersimpan dan terdokumentasi
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'a', 6, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada sosialisasi hasil penilaian dan pemantauan progres yang terdokumentasi dengan baik kepada manajemen (misal Direksi) serta pemangku kepentingan terkait (misal semua personel risiko manajemen, beserta personel Lini Pertama/Lini Ketiga terkait) untuk memperkuat kepemilikan kematangan risiko di antara semua pihak yang berkepentingan
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada sosialisasi hasil penilaian kepada manajemen (misal Direksi) yang terdokumentasi dengan baik
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'a', 7, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah dilakukan verifikasi/audit penilaian kematangan risiko oleh pihak independen (misal audit internal, atau tinjauan oleh pihak eksternal independen) sebagai “check-andbalance” untuk meminimalisir potensi bias dalam penilaian
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'a', 8, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada bukti yang jelas atas kinerja implementasi Indeks Kematangan Risiko, di antaranya:
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'a', 9, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            A. Peningkatan nilai Indeks Kematangan Risiko secara year-on-year, baik di level Holding maupun anak perusahaan (jika relevan)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'a', 10, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            B. Inisiatif dan rencana tindakan perbaikan dilaksanakan sepenuhnya (100%) selama periode pelaporan sesuai dengan peta jalan dan tata waktu yang telah disusun
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'a', 11, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            BUMN dengan skor maturitas pada parameter ini telah menerapkan tata kelola risiko yang dapat berpengaruh pada tercapainya kinerja keuangan & non-keuangan yang bersumber dari operasional BUMN yaitu >110% dari target RKAP
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            BUMN dengan skor maturitas pada parameter ini telah menerapkan tata kelola risiko yang dapat berpengaruh pada tercapainya kinerja keuangan & non-keuangan yang bersumber dari operasional BUMN yaitu 105-110% dari target RKAP
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            BUMN dengan skor maturitas pada parameter ini telah menerapkan tata kelola risiko yang dapat berpengaruh tercapainya kinerja keuangan & non-keuangan yang bersumber dari operasional BUMN yaitu 100-105% dari target RKAP
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            BUMN dengan skor maturitas pada parameter ini belum optimal dalam menerapkan tata kelola risiko yang dapat berpengaruh pada tidak tercapainya kinerja keuangan & non-keuangan yang bersumber dari operasional BUMN sesuai target RKAP
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                    </tr>


                    <!--SUBDIMENSI 3-->
                    <tr>
                        <th colspan="10" class="px-3 py-1 bg-orange-300 text-left text-[10px] font-semibold text-gray-700 uppercase tracking-wider">
                            Sub Dimensi 3. Kapabilitas Risiko</th>
                    <tr>
                        <td rowspan="15" class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            3. Program peningkatan keahlian risiko
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'b', 0, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada program peningkatan keahlian risiko
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada program peningkatan keahlian risiko
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada program peningkatan keahlian risiko
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada program peningkatan keahlian risiko
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top align-top">
                            Telah ada program peningkatan keahlian risiko namun:
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'b', 1, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Program dapat diakses oleh semua pegawai
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Program dapat diakses oleh semua pegawai
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Program dapat diakses oleh semua pegawai
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Program dapat diakses oleh sebagian besar pegawai
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Program belum diterapkan ke seluruh pegawai (misal hanya dikhususkan untuk Dewan Komisaris) sehingga tingkat pelatihannya rendah (misal program pelatihan risiko hanya diberikan kepada kurang dari 1% total jumlah pegawai)
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'b', 2, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Program disesuaikan dengan tingkat keahlian/jabatan, khususnya untuk personel risiko dan anggota Dewan Komisaris/Direksi
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Program disesuaikan dengan keahlian pegawai (yang memiliki akses ke pelatihan ini)

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Program pelatihan belum disesuaikan dengan tingkat keahlian pegawai
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Program pelatihan belum disesuaikan dengan tingkat keahlian pegawai
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>

                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'b', 3, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Topik program bersifat komprehensif (mencakup seluruh pilar manajemen risiko seperti budaya risiko, tata kelola risiko, kerangka Enterprise Risk Management dan kepatuhan risiko, proses dan kontrol risiko, dan teknologi risiko (misal data, sistem, model)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Topik program bersifat komprehensif (mencakup seluruh pilar manajemen risiko seperti budaya risiko, tata kelola risiko, kerangka Enterprise Risk Management dan kepatuhan risiko, proses dan kontrol risiko, dan teknologi risiko (misal data, sistem, model)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Topik program bersifat komprehensif (mencakup seluruh pilar Manajemen Risiko seperti budaya risiko, tata kelola risiko, kerangka Enterprise Risk Management dan kepatuhan risiko, proses dan kontrol risiko, dan teknologi risiko (misal data, sistem, model)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Topik yang dibahas dalam program kemungkinan belum komprehensif (misal belum mencakup seluruh pilar utama manajemen risiko seperti budaya risiko, tata kelola risiko, kerangka Enterprise Risk Management, kepatuhan risiko, proses dan kontrol risiko, serta teknologi risiko)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>

                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'b', 4, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Program bersifat wajib dan rutin (paling sedikit satu kali dalam setahun), dan telah diterapkan sanksi untuk ketidakhadiran
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Program bersifat wajib dan rutin (paling sedikit satu kali dalam setahun)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Program bersifat wajib dan rutin (paling sedikit satu kali dalam setahun)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Program tidak bersifat wajib/rutin (misal hanya dilakukan secara ad-hoc)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Program tidak bersifat wajib/rutin (misal hanya dilakukan secara adhoc)
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'b', 5, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Tingkat kehadiran pelatihan relatif tinggi di beberapa divisi saja (misal divisi Manajemen Risiko)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'b', 6, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Kurikulum ditinjau secara rutin dan formal berdasarkan kebutuhan pelatihan pegawai, serta melalui proses pembaruan setiap tahun untuk memastikan kualitasnya dan diperbarui agar sesuai dengan risiko-risiko utama dan praktik terbaik Manajemen Risiko (misal terus diperbarui dengan standar internasional terkini)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Kurikulum ditinjau secara rutin dan formal berdasarkan kebutuhan pelatihan pegawai, serta melalui proses pembaruan setiap tahun untuk memastikan kualitasnya dan diperbarui agar sesuai dengan risiko-risiko utama dan praktik terbaik Manajemen Risiko (misal terus diperbarui dengan standar internasional terkini)
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Program belum diperbarui secara rutin (misal tidak dilakukan tinjauan setiap tahunnya)

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'b', 7, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada “feedback-loop”/pengumpulan feedback terdokumentasi dari pegawai yang telah menerima pelatihan risiko, untuk menilai manfaat dari pelatihan risiko terhadap keahlian pegawai dalam menjalankan pekerjaannya, serta memberikan masukan untuk pengembangan program pelatihan secara berkesinambungan
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'b', 8, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah dilakukan analisis untuk menilai keberhasilan/ruang perbaikan program, termasuk area-area di mana pegawai belum menunjukkan kinerja yang baik dan membutuhkan pelatihan/tes lebih lanjut pada siklus pelatihan berikutnya
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'b', 9, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Perusahaan terus melakukan terobosan dalam pembelajaran melalui kolaborasi dengan penyedia program pelatihan Manajemen Risiko sesuai industri yang dijalankannya untuk mengedukasi pegawainya terkait praktik terbaik global Manajemen Risiko (khususnya untuk pegawai di jabatan Manajemen penting/personel Unit Bisnis dan divisi Manajemen Risiko)
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'b', 10, this.value)" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Telah ada bukti yang jelas atas kinerja implementasi pelatihan risiko, di antaranya:
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'b', 11, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Penyelesaian penuh untuk pelatihan wajib terkait manajemen risiko/kesadaran risiko untuk semua pegawai
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'b', 12, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Penyelesaian penuh untuk pelatihan wajib terkait manajemen risiko/kesadaran risiko untuk semua pegawai
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'b', 13, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            Penyelesaian penuh untuk pelatihan wajib terkait manajemen risiko/kesadaran risiko untuk semua pegawai
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">

                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="kutipandanbukti" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="temuandangap" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> type="text" id="sumberdata" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap border border-gray-400 bg-white text-xl font-bold">
                            <textarea <?php if($_SESSION['role'] == 'user'){ echo 'disabled'; } ?> onchange="changeValue('dimension1', 'sub2', 'b', 14, this.value)" type="number" id="nilai" class="w-full text-center" style="height: 100px; display: flex; align-items: center; justify-content: center;"></textarea>
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            BUMN dengan skor maturitas pada parameter ini telah menerapkan tata kelola risiko yang dapat berpengaruh pada tercapainya kinerja keuangan & non-keuangan yang bersumber dari operasional BUMN yaitu >110% dari target RKAP
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            BUMN dengan skor maturitas pada parameter ini telah menerapkan tata kelola risiko yang dapat berpengaruh pada tercapainya kinerja keuangan & non-keuangan yang bersumber dari operasional BUMN yaitu 105-110% dari target RKAP
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            BUMN dengan skor maturitas pada parameter ini telah menerapkan tata kelola risiko yang dapat berpengaruh tercapainya kinerja keuangan & non-keuangan yang bersumber dari operasional BUMN yaitu 100-105% dari target RKAP
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                            BUMN dengan skor maturitas pada parameter ini belum optimal dalam menerapkan tata kelola risiko yang dapat berpengaruh pada tidak tercapainya kinerja keuangan & non-keuangan yang bersumber dari operasional BUMN sesuai target RKAP
                        </td>
                        <td class="text-gray-900 whitespace-no-wrap px-3 py-3 border border-gray-400 bg-white text-sm align-top">
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>

<script src="script.js"></script>
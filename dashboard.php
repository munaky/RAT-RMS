<?php
session_start();

include('Data.php');
include('Database.php');

if (!$_SESSION['username'] && !$_SESSION['password']) {
    header('location: login.php');
};

$projects = getProjects();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                < </button>

                    <div class="flex items-end justify-center space-x-2">
                        <svg width="18" height="25" viewBox="0 0 42 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M37.3333 5.3H27.58C26.6 2.226 24.0333 0 21 0C17.9667 0 15.4 2.226 14.42 5.3H4.66667C2.1 5.3 0 7.685 0 10.6V47.7C0 50.615 2.1 53 4.66667 53H37.3333C39.9 53 42 50.615 42 47.7V10.6C42 7.685 39.9 5.3 37.3333 5.3ZM21 5.3C22.2833 5.3 23.3333 6.4925 23.3333 7.95C23.3333 9.4075 22.2833 10.6 21 10.6C19.7167 10.6 18.6667 9.4075 18.6667 7.95C18.6667 6.4925 19.7167 5.3 21 5.3ZM25.6667 42.4H9.33333V37.1H25.6667V42.4ZM32.6667 31.8H9.33333V26.5H32.6667V31.8ZM32.6667 21.2H9.33333V15.9H32.6667V21.2Z" fill="black" />
                        </svg>
                        <h3 class="font-semibold text-xl mb-[-2px]">Dashboard</h3>
                    </div>
                    <hr class="w-full mt-3">

                    <h3 class="text-neutral-400 mt-5 tracking-wide">Activity</h3>
                    <a href="kajidokumen.php" class="flex items-end justify-start space-x-2 mt-3 group">
                        <svg width="12" height="17" viewBox="0 0 34 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M30.2222 4.3H22.3267C21.5333 1.806 19.4556 0 17 0C14.5444 0 12.4667 1.806 11.6733 4.3H3.77778C1.7 4.3 0 6.235 0 8.6V38.7C0 41.065 1.7 43 3.77778 43H30.2222C32.3 43 34 41.065 34 38.7V8.6C34 6.235 32.3 4.3 30.2222 4.3ZM17 4.3C18.0389 4.3 18.8889 5.2675 18.8889 6.45C18.8889 7.6325 18.0389 8.6 17 8.6C15.9611 8.6 15.1111 7.6325 15.1111 6.45C15.1111 5.2675 15.9611 4.3 17 4.3ZM20.7778 34.4H7.55556V30.1H20.7778V34.4ZM26.4444 25.8H7.55556V21.5H26.4444V25.8ZM26.4444 17.2H7.55556V12.9H26.4444V17.2Z" fill="#8E8E8E" />
                        </svg>

                        <h3 class="text-neutral-400 font-light tracking-wide mb-[-4px] group-hover:text-neutral-800 transition-all duration-500" style="cursor: pointer;">Kaji Dokumen</h3>
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



        <div class="mt-20 grid grid-cols-5 p-14 transition-all w-full h-max duration-500" style="margin-left:13rem;" id="table">
            <?php foreach ($projects as $project) { ?>

                <a href="kajidokumen.php?id=<?php echo $project['id'] ?>&project=<?php echo $project['name'] ?>" style=" cursor:pointer" class="bg-white h-[10rem] px-6 flex flex-col w-[15rem] items-center shadow-md hover:shadow-lg hover:scale-105 transition-all duration-500 shadow-neutral-200 justify-center rounded-md">
                    <h1 class="font-semibold text-3xl mb-3"><?php echo $project['name'] ?></h1>
                    <p class="text-neutral-500 text-sm">30 Nov 2023 05:22:13 GMT</p>
                </a>
            <?php }; ?>

            <button onclick="toggleModal()" class="bg-white w-[15rem] h-[10rem] px-6 flex flex-col text-neutral-400 hover:text-neutral-800 items-center shadow-md hover:shadow-lg hover:scale-105 transition-all duration-500 shadow-neutral-200 justify-center rounded-md">
                <h1 class="font-semibold text-3xl">+</h1>
            </button>
        </div>

    </div>
    <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="modal">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75"> </div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <form action="create_project.php" method="post">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <label class="font-medium text-gray-800">Nama Project</label>
                        <input name="name" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                        <label class="font-medium text-gray-800">Nama Perusahaan</label>
                        <input name="company" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                        <label class="font-medium text-gray-800">Logo perusahaan</label>
                        <div class="w-[10rem] h-[10rem] bg-neutral-300 rounded-lg font-semibold flex items-center justify-center text-5xl text-neutral-600 mb-3 mt-2">
                            +
                        </div>
                        <label class="font-medium text-gray-800">Alamat Perusahaan</label>
                        <input name="address" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                        <label class="font-medium text-gray-800">Detail Perusahaan</label>
                        <input name="detail" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                    </div>
                    <div class="bg-gray-200 px-4 py-3 text-right">
                        <button type="button" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2" onclick="toggleModal()"><i class="fas fa-times"></i> Cancel</button>
                        <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 mr-2"><i class="fas fa-plus"></i> Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    function toggleModal() {
        document.getElementById('modal').classList.toggle('hidden')
    }
</script>
</body>

</html>

<script src="script.js"></script>
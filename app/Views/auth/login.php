<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Apriori Analysis</title>
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm lg:max-w-4xl overflow-hidden">
        <div class="flex flex-col lg:flex-row min-h-[550px]">

            <div class="lg:w-1/2 bg-green-600 p-8 flex flex-col items-center justify-center text-center order-1 lg:order-2 rounded-t-xl lg:rounded-t-none lg:rounded-r-xl">

                <div class="text-white mb-6">
                    <svg class="w-20 h-20 lg:w-24 lg:h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18M3 10h4M9 3v4M15 10h4M9 15v4"></path>
                    </svg>
                </div>

                <div>
                    <h3 class="text-xl lg:text-2xl font-bold text-white mb-2 leading-tight">Analisis Pola Lokasi Properti</h3>
                    <p class="text-green-100 text-sm leading-relaxed max-w-xs mx-auto">
                        Temukan wawasan dan hubungan tersembunyi dari data Anda menggunakan algoritma Apriori.
                    </p>
                </div>
            </div>

            <div class="lg:w-1/2 p-8 lg:p-12 flex flex-col justify-center order-2 lg:order-1 rounded-b-xl lg:rounded-b-none lg:rounded-l-xl">
                <div class="max-w-sm mx-auto w-full">
                    <div class="text-left mb-8">
                        <h1 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-2">Login Akun</h1>
                        <p class="text-gray-500 text-sm">Masuk untuk memulai Analisis Pola Properti.</p>
                    </div>

                    <form action="<?= base_url('/login') ?>" method="post" class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                            <input type="text" name="username" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                                placeholder="Masukkan username Anda">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                                placeholder="Masukkan password Anda">
                        </div>

                        <button type="submit"
                            class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition-colors duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Masuk
                        </button>

                        <div class="text-center pt-3">
                            <p class="text-gray-500 text-sm">
                                Belum punya akun?
                                <a href="<?= site_url('register') ?>" class="text-green-600 hover:text-green-700 font-medium">
                                    Daftar di sini
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <?php
    // Blok PHP untuk notifikasi tidak perlu diubah
    $successMessage = session()->getFlashdata('success');
    if ($successMessage):
    ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= esc($successMessage, 'js') ?>',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = "<?= base_url('/home') ?>";
            });
        </script>
    <?php endif; ?>

    <?php
    $errorMessage = session()->getFlashdata('error');
    if ($errorMessage) :
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '<?= esc($errorMessage, 'js') ?>',
            });
        </script>
    <?php endif; ?>

</body>

</html>
<aside id="sidebar" class="bg-white w-64 min-h-screen flex flex-col fixed inset-y-0 left-0 z-30
                           transform -translate-x-full md:relative md:translate-x-0
                           transition-transform duration-300 ease-in-out border-r border-gray-200">

    <div class="flex items-center justify-center p-6 border-b border-gray-200">
        <i class="fa-solid fa-magnifying-glass-chart fa-lg mr-3 text-green-600"></i>
        <h1 class="text-xl font-bold tracking-wider text-gray-800">AprioriApp</h1>
    </div>

    <div class="flex-grow p-4">
        <ul class="space-y-2">
            <li>
                <a href="<?= base_url('/home') ?>" class="flex items-center gap-4 px-4 py-3 rounded-lg transition-all duration-200
                   <?= ($active_menu ?? '') === 'home' ? 'bg-green-600 text-white font-semibold shadow-md' : 'text-gray-700 hover:bg-green-600 hover:text-white' ?>">
                    <i class="fa-solid fa-house w-6 text-center text-xl"></i>
                    <span class="font-medium">Home</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('/dataset') ?>" class="flex items-center gap-4 px-4 py-3 rounded-lg transition-all duration-200
                   <?= ($active_menu ?? '') === 'dataset' ? 'bg-green-600 text-white font-semibold shadow-md' : 'text-gray-700 hover:bg-green-600 hover:text-white' ?>">
                    <i class="fa-solid fa-database w-6 text-center text-xl"></i>
                    <span class="font-medium">Dataset</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('/analisis') ?>" class="flex items-center gap-4 px-4 py-3 rounded-lg transition-all duration-200
                   <?= ($active_menu ?? '') === 'analisis' ? 'bg-green-600 text-white font-semibold shadow-md' : 'text-gray-700 hover:bg-green-600 hover:text-white' ?>">
                    <i class="fa-solid fa-chart-line w-6 text-center text-xl"></i>
                    <span class="font-medium">Analisis Apriori</span>
                </a>
            </li>
            <li>
                <a href="<?= site_url('/history') ?>" class="flex items-center gap-4 px-4 py-3 rounded-lg transition-all duration-200
       <?= ($active_menu ?? '') === 'history' ? 'bg-green-600 text-white font-semibold shadow-md' : 'text-gray-700 hover:bg-green-600 hover:text-white' ?>">
                    <i class="fa-solid fa-clock-rotate-left w-6 text-center text-xl"></i>
                    <span class="font-medium">History Analisis</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="p-4 border-t border-gray-200">
        <div class="flex items-center mb-4">
            <img
                src="<?= base_url('uploads/foto_profil/' . esc(session()->get('foto'))) ?>"
                alt="Foto Profil"
                class="w-12 h-12 rounded-full object-cover border-2 border-green-500">
            <div class="ml-4">
                <p class="text-sm font-semibold text-gray-800">
                    <?= esc(session()->get('username')) ?>
                </p>
                <a href="<?= base_url('/akun') ?>" class="text-xs text-green-600 hover:text-green-700 hover:underline">
                    Lihat Akun
                </a>
            </div>
        </div>

        <a href="<?= site_url('logout') ?>" class="flex items-center justify-center gap-3 w-full px-4 py-2.5 rounded-lg transition-all duration-200 bg-green-600 text-white hover:bg-red-600 hover:text-white">
            <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>
            <span class="font-medium text-sm">Logout</span>
        </a>
    </div>
</aside>
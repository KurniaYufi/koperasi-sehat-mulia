<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Koperasi Sehat Mulia</title>
        <link rel="icon" type="image/png" href="/images/logo.png">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />

        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }

            /* Animasi Hover Service Card (Sesuai Request) */
            .service-card:hover .service-content {
                transform: translateY(0);
            }
            .service-content {
                transform: translateY(100%); /* Hidden by default */
                transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .service-card:hover img {
                transform: scale(1.1);
            }
            .service-card:hover .static-title {
                opacity: 0;
            }
        </style>
    </head>
    <body class="bg-slate-50 text-slate-800 antialiased overflow-x-hidden">

        <nav class="fixed w-full z-50 bg-white/95 backdrop-blur-sm border-b border-slate-100 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center gap-3">
                        <img src="/images/logo.png" onerror="this.src='https://via.placeholder.com/40x40/0f2a27/ffffff?text=KSM'" alt="Logo" class="w-10 h-10 rounded-lg object-contain">
                        <div class="flex flex-col">
                            <span class="text-lg font-bold text-[#0f2a27] leading-none">KOPERASI</span>
                            <span class="text-sm font-bold text-[#994c2e] uppercase tracking-widest leading-none">SEHAT MULIA</span>
                        </div>
                    </div>

                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#" class="text-sm font-medium text-[#0f2a27]">Beranda</a>
                        <a href="#ikhtisar" class="text-sm font-medium text-slate-500 hover:text-[#0f2a27] transition-colors">Tentang Kami</a>
                        <a href="#unit-usaha" class="text-sm font-medium text-slate-500 hover:text-[#0f2a27] transition-colors">Unit Usaha</a>
                        <a href="#kontak" class="text-sm font-medium text-slate-500 hover:text-[#0f2a27] transition-colors">Kontak</a>
                    </div>

                    <div class="hidden md:flex items-center gap-4">
                        <a href="/login" class="px-5 py-2.5 text-sm font-semibold text-white bg-[#0f2a27] rounded-full hover:bg-[#153834] transition shadow-lg shadow-[#0f2a27]/20">
                            Login
                        </a>
                    </div>

                    <button id="mobile-menu-btn" class="md:hidden text-[#0f2a27]">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-slate-100 absolute w-full shadow-xl">
                <div class="px-4 py-4 space-y-2">
                    <a href="#" class="block px-4 py-2 text-sm font-bold text-[#0f2a27] bg-slate-50 rounded-lg">Beranda</a>
                    <a href="#ikhtisar" class="block px-4 py-2 text-sm font-medium text-slate-600">Ikhtisar</a>
                    <a href="#unit-usaha" class="block px-4 py-2 text-sm font-medium text-slate-600">Unit Usaha</a>
                    <div class="pt-4 mt-2 border-t border-slate-100">
                        <a href="/login" class="block w-full text-center py-3 bg-[#0f2a27] text-white font-bold rounded-lg">Login</a>
                    </div>
                </div>
            </div>
        </nav>

        <section class="relative min-h-[90vh] flex items-center justify-center pt-20 overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Office Collaboration" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-[#0f2a27]/95 via-[#0f2a27]/80 to-[#0f2a27]/40"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="text-white" data-aos="fade-up" data-aos-duration="1000">
                        <h1 class="text-4xl lg:text-6xl font-extrabold leading-tight mb-6">
                            Mewujudkan <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#dca58d] to-white">Kemakmuran & Kesejahteraan</span>
                        </h1>
                        <p class="text-lg text-slate-200 mb-8 leading-relaxed max-w-lg">
                            Koperasi Sehat Mulia hadir sebagai mitra yang tepercaya dalam menciptakan kehidupan anggota yang lebih stabil, sejahtera, dan penuh harapan.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="#unit-usaha" class="px-8 py-4 bg-[#994c2e] hover:bg-[#853f24] text-white font-semibold rounded-lg transition-all transform hover:-translate-y-1 shadow-lg">
                                Lihat Unit Usaha
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="ikhtisar" class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row gap-16 items-start">

                    <div class="w-full md:w-5/12 sticky top-24" data-aos="fade-right">
                        <span class="text-[#994c2e] font-bold uppercase tracking-widest text-sm mb-2 block">Tentang KSM</span>
                        <h2 class="text-4xl font-bold text-[#0f2a27] leading-tight mb-6">Ikhtisar</h2>
                        <div class="text-slate-600 text-lg leading-relaxed mb-6 space-y-4">
                            <p>
                                Koperasi Sehat Mulia adalah koperasi yang berkomitmen mewujudkan kemakmuran dan kesejahteraan anggotanya melalui layanan yang aman, transparan, dan berkelanjutan.
                                Setiap program yang dijalankan dirancang untuk mendukung kemandirian ekonomi, memperkuat kebersamaan, dan membantu anggota tumbuh secara finansial maupun sosial.
                            </p>
                            <p>
                                Dengan prinsip saling memberdayakan, Koperasi Sehat Mulia hadir sebagai mitra yang tepercaya dalam menciptakan kehidupan anggota yang lebih stabil, sejahtera, dan penuh harapan.
                            </p>
                        </div>
                    </div>

                    <div class="w-full md:w-7/12 flex flex-col gap-6" data-aos="fade-left">
                        <div class="bg-[#f8fafa] p-8 rounded-2xl border border-slate-100 hover:border-[#994c2e]/30 transition duration-300">
                            <h3 class="text-2xl font-bold text-[#0f2a27] mb-4 flex items-center gap-2">
                                <span class="w-2 h-8 bg-[#994c2e] rounded-full"></span> Visi
                            </h3>
                            <p class="text-slate-700 text-lg italic font-medium">
                                "Menjadi koperasi yang unggul dan berkelanjutan dalam meningkatkan kesejahteraan anggota."
                            </p>
                        </div>

                        <div class="bg-[#f8fafa] p-8 rounded-2xl border border-slate-100 hover:border-[#994c2e]/30 transition duration-300">
                            <h3 class="text-2xl font-bold text-[#0f2a27] mb-4 flex items-center gap-2">
                                <span class="w-2 h-8 bg-[#994c2e] rounded-full"></span> Misi
                            </h3>
                            <ul class="space-y-3 text-slate-600">
                                <li class="flex gap-3">
                                    <span class="text-[#994c2e] font-bold">•</span>
                                    Meningkatkan kesejahteraan anggota melalui pelayanan keuangan yang profesional dan berintegritas.
                                </li>
                                <li class="flex gap-3">
                                    <span class="text-[#994c2e] font-bold">•</span>
                                    Mengembangkan program dan unit usaha yang mendukung kesejahteraan karyawan.
                                </li>
                                <li class="flex gap-3">
                                    <span class="text-[#994c2e] font-bold">•</span>
                                    Meningkatkan kesadaran dan partisipasi anggota dalam pengelolaan koperasi.
                                </li>
                                <li class="flex gap-3">
                                    <span class="text-[#994c2e] font-bold">•</span>
                                    Membangun kerjasama dengan pihak ketiga untuk meningkatkan manfaat anggota.
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="unit-usaha" class="py-24 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-3xl lg:text-4xl font-bold text-[#0f2a27] mb-4">Unit Usaha</h2>
                    <div class="w-24 h-1 bg-[#994c2e] mx-auto rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <div class="group service-card relative h-[400px] w-full overflow-hidden rounded-2xl cursor-pointer shadow-lg" data-aos="fade-up" data-aos-delay="0">
                        <img src="images/service1.jpg"
                             alt="Simpan Pinjam"
                             class="absolute inset-0 h-full w-full object-cover transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0f2a27] via-[#0f2a27]/20 to-transparent opacity-90 transition-opacity duration-300"></div>

                        <div class="static-title absolute bottom-6 left-6 right-6 transition-opacity duration-300">
                            <h3 class="text-2xl font-bold text-white">Simpan<br>Pinjam</h3>
                        </div>

                        <div class="absolute inset-0 bg-[#0f2a27]/90 flex flex-col justify-end p-8 text-white service-content">
                            <div class="w-12 h-1 bg-[#994c2e] mb-4"></div>
                            <h3 class="text-2xl font-bold mb-2">Simpan Pinjam</h3>
                            <p class="text-slate-300 text-sm">Layanan simpanan dan pinjaman untuk kebutuhan finansial anggota.</p>
                        </div>
                    </div>

                    <div class="group service-card relative h-[400px] w-full overflow-hidden rounded-2xl cursor-pointer shadow-lg" data-aos="fade-up" data-aos-delay="100">
                        <img src="images/service2.webp"
                             alt="Pengadaan Barang"
                             class="absolute inset-0 h-full w-full object-cover transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0f2a27] via-[#0f2a27]/20 to-transparent opacity-90 transition-opacity duration-300"></div>

                        <div class="static-title absolute bottom-6 left-6 right-6 transition-opacity duration-300">
                            <h3 class="text-2xl font-bold text-white">Pengadaan<br>Barang & Jasa</h3>
                        </div>

                        <div class="absolute inset-0 bg-[#0f2a27]/90 flex flex-col justify-end p-8 text-white service-content">
                            <div class="w-12 h-1 bg-[#994c2e] mb-4"></div>
                            <h3 class="text-2xl font-bold mb-2">Pengadaan Barang & Jasa</h3>
                            <p class="text-slate-300 text-sm">Penyediaan kebutuhan barang dan jasa yang berkualitas.</p>
                        </div>
                    </div>

                    <div class="group service-card relative h-[400px] w-full overflow-hidden rounded-2xl cursor-pointer shadow-lg" data-aos="fade-up" data-aos-delay="200">
                        <img src="images/service3.jpg"
                             alt="Layanan Kesehatan"
                             class="absolute inset-0 h-full w-full object-cover transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0f2a27] via-[#0f2a27]/20 to-transparent opacity-90 transition-opacity duration-300"></div>

                        <div class="static-title absolute bottom-6 left-6 right-6 transition-opacity duration-300">
                            <h3 class="text-2xl font-bold text-white">Layanan<br>Kesehatan</h3>
                        </div>

                        <div class="absolute inset-0 bg-[#0f2a27]/90 flex flex-col justify-end p-8 text-white service-content">
                            <div class="w-12 h-1 bg-[#994c2e] mb-4"></div>
                            <h3 class="text-2xl font-bold mb-2">Layanan Kesehatan</h3>
                            <p class="text-slate-300 text-sm">Dukungan kesehatan untuk kesejahteraan anggota.</p>
                        </div>
                    </div>

                    <div class="group service-card relative h-[400px] w-full overflow-hidden rounded-2xl cursor-pointer shadow-lg" data-aos="fade-up" data-aos-delay="300">
                        <img src="images/service4.avif"
                             alt="Investasi"
                             class="absolute inset-0 h-full w-full object-cover transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0f2a27] via-[#0f2a27]/20 to-transparent opacity-90 transition-opacity duration-300"></div>

                        <div class="static-title absolute bottom-6 left-6 right-6 transition-opacity duration-300">
                            <h3 class="text-2xl font-bold text-white">Investasi<br>bersama KSM</h3>
                        </div>

                        <div class="absolute inset-0 bg-[#0f2a27]/90 flex flex-col justify-end p-8 text-white service-content">
                            <div class="w-12 h-1 bg-[#994c2e] mb-4"></div>
                            <h3 class="text-2xl font-bold mb-2">Investasi bersama KSM</h3>
                            <p class="text-slate-300 text-sm">Peluang pertumbuhan finansial bersama koperasi.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="py-20 bg-white border-t border-slate-100">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h2 class="text-2xl md:text-3xl font-bold text-[#0f2a27] mb-8 leading-normal">
                    "Jika Anda ingin berbagi lebih banyak, jangan ragu untuk menghubungi kami melalui saluran yang tersedia."
                </h2>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#kontak" class="inline-flex items-center justify-center px-8 py-3 bg-[#0f2a27] text-white font-bold rounded-lg hover:bg-[#153834] transition">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </section>

        <footer id="kontak" class="bg-[#0b201d] text-slate-300 border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col md:flex-row justify-between items-start gap-12">
                    <div class="md:w-1/3">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-2xl font-bold text-white">Koperasi Sehat Mulia</span>
                        </div>
                        <p class="text-sm leading-relaxed mb-6 text-slate-400">
                            Mewujudkan kemakmuran dan kesejahteraan anggota melalui layanan yang aman, transparan, dan berkelanjutan.
                        </p>
                        <div class="text-xs text-slate-500">
                            © 2026 Koperasi Sehat Mulia.
                        </div>
                    </div>

                    <div class="md:w-1/3">
                        <h4 class="text-white font-bold mb-4">Alamat Kami</h4>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-[#994c2e] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                <span>
                                    Jl. Percetakan Negara<br>
                                    Jakarta Pusat
                                </span>
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-[#994c2e] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                <span>Telp: 0852-1129-6877</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-[#994c2e] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                <span>Email: mail.koperasisehatmulia@gmail.com</span>
                            </li>
                        </ul>
                    </div>

                    <div class="md:w-1/3 w-full">
                        <div class="h-40 w-full rounded-xl overflow-hidden bg-slate-800 relative group">
                             <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2676.6501089982307!2d106.85231814852483!3d-6.191739757190267!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f45cf2e9b863%3A0x79e7054847d63c86!2sYakes-Telkom!5e0!3m2!1sen!2sid!4v1770300905372!5m2!1sen!2sid"
                                width="100%"
                                height="100%"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                class="absolute inset-0 grayscale group-hover:grayscale-0 transition duration-500">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script>
            // Initialize AOS Animation
            AOS.init({
                duration: 800,
                once: true,
                offset: 50,
            });

            // Mobile Menu Toggle
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');

            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        </script>
    </body>
</html>

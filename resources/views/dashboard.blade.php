@extends('layout.app')

@section('title', 'TPS 3R SIDO MAKMUR')

@section('content')
    <div class="page-container">
        <button class="scroll-btn left" onclick="scrollPage('left')">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <div class="slides-wrapper">
            <div class="hero">
                <div class="hero-text">
                    <h1><span class="highlight">Pilah Sampah</span><br>Rangkai Masa Depan</h1>
                    <p>Kelola sampah dengan bijak untuk masa depan yang lebih bersih. Dukungan teknologi membawa perubahan
                        nyata bagi lingkungan</p>
                </div>
                <div class="hero-image">
                    <img src="{{ asset('images/laptop-mockup1.png') }}" alt="Mockup Sistem TPS 3R">
                </div>
            </div>

            <div class="hero">
                <div class="hero-text">
                    <h1><span class="highlight">Dari Sisa Menjadi Asa</span></h1>
                    <p>Yang kita buang hari ini,
                        bisa jadi harapan esok hari.
                        Sampah bukan akhir segalanya
                        tapi awal dari perubahan
                        saat kita memilih untuk peduli.</p>
                </div>
                <div class="hero-image">
                    <img src="{{ asset('images/abababa.png') }}" alt="Keunggulan TPS 3R">
                </div>
            </div>

            <div class="hero">
                <div class="hero-text">
                    <h1><span class="highlight">Jejak Hijau dari Tumpukan</span></h1>
                    <p>Di balik tumpukan sampah,
                        ada jejak hijau yang bisa kita ciptakan.
                        Lewat daur ulang, lewat kepedulian kecil
                        kita tinggalkan bumi yang lebih baik.</p>
                </div>
                <div class="hero-image">
                    <img src="{{ asset('images/asasasa.png') }}" alt="Aksi Bersama">
                </div>
            </div>

            <div class="hero">
                <div class="hero-text">
                    <h1><span class="highlight">Ruang Tersisa, Harapan Tumbuh</span></h1>
                    <p>Dari sampah yang kita kelola,
                        muncul ruang untuk bumi bernapas.
                        Sedikit demi sedikit, harapan tumbuh
                        karena perubahan dimulai dari hal kecil.</p>
                </div>
                <div class="hero-image">
                    <img src="{{ asset('images/adada.png') }}" alt="Aksi Bersama">
                </div>
            </div>
        </div>

        <button class="scroll-btn right" onclick="scrollPage('right')">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>

    <div class="info-bar">
        <h2>Informasi</h2>
        <p>TPS 3R SIDO MAKMUR adalah tempat pengelolaan sampah berbasis masyarakat yang mengedepankan prinsip 3R (Reduce,
            Reuse, Recycle).</p>
        <p>Kami berkomitmen menciptakan lingkungan bersih, sehat, dan berkelanjutan melalui teknologi dan keterlibatan
            masyarakat.</p>
    </div>

    @push('styles')
        <style>
            .page-container {
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                overflow: hidden;
            }

            .scroll-btn {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background-color: rgba(106, 184, 110, 0.85);
                color: white;
                border: none;
                width: 50px;
                height: 50px;
                font-size: 24px;
                cursor: pointer;
                z-index: 10;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
                transition: background-color 0.3s, transform 0.2s ease;
            }

            .scroll-btn:hover {
                background-color: rgba(46, 125, 50, 1);
                transform: translateY(-50%) scale(1.05);
            }

            .left {
                left: 20px;
            }

            .right {
                right: 20px;
            }

            .slides-wrapper {
                display: flex;
                transition: transform 0.5s ease;
                width: 100%;
            }

            .hero {
                min-width: 100%;
                max-width: 1200px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 50px;
                box-sizing: border-box;
            }

            .hero-text {
                color: #2e7d32;
                max-width: 50%;
            }

            .hero-text h1 {
                font-size: 48px;
                margin: 0 0 20px;
            }

            .hero-text p {
                font-size: 18px;
            }

            .hero-image img {
                max-width: 100%;
                border-radius: 15px;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }

            .info-bar {
                background-color: #ffffff;
                margin: 40px auto;
                padding: 30px;
                max-width: 1000px;
                border-radius: 12px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                color: #2e7d32;
                text-align: center;
            }

            .info-bar h2 {
                margin-bottom: 15px;
                font-size: 32px;
            }

            .info-bar p {
                font-size: 16px;
                color: #333;
            }

            /* Tambahan Responsif */
            @media (max-width: 768px) {
                .hero {
                    flex-direction: column;
                    padding: 20px;
                    text-align: center;
                }

                .hero-text {
                    max-width: 100%;
                }

                .hero-text h1 {
                    font-size: 32px;
                }

                .hero-text p {
                    font-size: 16px;
                }

                .hero-image {
                    margin-top: 20px;
                }

                .scroll-btn {
                    width: 40px;
                    height: 40px;
                    font-size: 20px;
                }

                .info-bar {
                    margin: 20px 10px;
                    padding: 20px;
                }

                .info-bar h2 {
                    font-size: 24px;
                }

                .info-bar p {
                    font-size: 14px;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            let currentSlide = 0;

            function scrollPage(direction) {
                const slides = document.querySelectorAll('.hero');
                const wrapper = document.querySelector('.slides-wrapper');
                const totalSlides = slides.length;

                if (direction === 'right') {
                    currentSlide = (currentSlide + 1) % totalSlides;
                } else {
                    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                }

                wrapper.style.transform = `translateX(-${currentSlide * 100}%)`;
            }
        </script>
    @endpush
@endsection

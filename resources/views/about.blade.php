@extends('layout.app')

@section('title', 'Tentang Kami')

@push('styles')
    <style>
        .about-section {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 60px 20px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 50px;
        }

        .about-text {
            max-width: 500px;
        }

        .about-text h2 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #2e7d32;
        }

        .about-text p {
            font-size: 16px;
            line-height: 1.8;
        }

        .about-image {
            max-width: 400px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .about-images {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
        }

        .activities-section {
            padding: 40px 20px;
            background: #ffffff;
            text-align: center;
        }

        .activities-section h3 {
            color: #2e7d32;
            margin-bottom: 30px;
        }

        .activity-gallery {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .activity-item img {
            width: 90%;
            max-width: 600px;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }
    </style>
@endpush

@section('content')
    <div class="about-section">
        <div class="about-text">
            <h2>Tentang Kami</h2>
            <p>
                TPS 3R Sido Makmur merupakan pusat pengelolaan sampah terpadu yang berbasis pada prinsip Reduce, Reuse, dan
                Recycle (3R) dengan pendekatan pemberdayaan masyarakat secara aktif dan berkelanjutan. Berdiri sebagai salah
                satu inisiatif lingkungan di tingkat lokal, TPS 3R Sido Makmur tidak hanya hadir untuk mengatasi persoalan
                sampah, tetapi juga menjadi motor penggerak perubahan pola pikir dan perilaku masyarakat terhadap pentingnya
                menjaga kelestarian lingkungan hidup.

                Melalui kolaborasi antara masyarakat, pemerintah, dan lembaga-lembaga terkait, kami menjalankan berbagai
                program edukasi dan sosialisasi pengelolaan sampah rumah tangga, pelatihan daur ulang, serta pelibatan
                langsung warga dalam proses pemilahan, pengumpulan, dan pengolahan sampah. Tujuan utama kami adalah
                menciptakan sistem pengelolaan sampah yang mandiri, transparan, dan produktif sehingga dapat memberikan
                manfaat sosial, ekonomi, dan ekologis.

                Kami percaya bahwa sampah bukanlah akhir dari siklus konsumsi, melainkan awal dari sebuah transformasi.
                Sampah organik kami olah menjadi kompos yang dapat digunakan kembali untuk pertanian dan penghijauan,
                sementara sampah anorganik dipilah untuk didaur ulang menjadi produk bernilai ekonomi, seperti kerajinan
                tangan, bahan bangunan alternatif, dan barang-barang siap jual. Pendekatan ini tidak hanya membantu
                mengurangi volume sampah yang dibuang ke TPA, tetapi juga membuka peluang usaha dan menciptakan lapangan
                kerja bagi masyarakat sekitar.

                Komitmen TPS 3R Sido Makmur terhadap keberlanjutan tercermin dalam upaya kami memperkuat kapasitas komunitas
                melalui edukasi, penguatan kelembagaan warga, serta pembangunan infrastruktur pengelolaan sampah yang
                efisien dan ramah lingkungan. Kami menjadikan nilai-nilai gotong royong, transparansi, dan inovasi sebagai
                landasan dalam setiap aktivitas, sehingga seluruh lapisan masyarakat dapat berkontribusi dan merasakan
                manfaat dari perubahan yang diciptakan.

                Dengan visi “Masyarakat Mandiri, Lingkungan Lestari”, TPS 3R Sido Makmur terus berinovasi dan memperluas
                dampak positif melalui pengembangan program berbasis data, integrasi teknologi sederhana, serta kemitraan
                strategis dengan berbagai pihak. Kami tidak hanya ingin menjadi solusi lokal atas persoalan sampah, tetapi
                juga menjadi inspirasi nasional bahwa perubahan besar dimulai dari tindakan kecil di lingkungan terdekat.
            </p>
        </div>
        <div class="about-images">
            <img src="{{ asset('images/about3.png') }}" alt="Tentang Kami" class="about-image">
            <img src="{{ asset('images/about4.png') }}" alt="Tentang Kami" class="about-image">
            <img src="{{ asset('images/about.png') }}" alt="Tentang Kami" class="about-image">
        </div>
    </div>

@endsection

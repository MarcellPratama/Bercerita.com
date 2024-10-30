<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <title>Bercerita.Com</title>
</head>

<body>
    <div class="beranda">
        <nav class="navbar navbar-expand-lg navbar-dark navbar-overlay" id="beranda">
            <div class="container-fluid">
                <a class="navbar-brand" href="#tentangKami">
                    <img src="<?= base_url('images/Logo Bercerita.com.png') ?>" alt="Bercerita.com" class="logo">
                </a>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#konsultasi">Konsultasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#ruangCerita">Ruang Cerita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#jejakPerasaan">Jejak Perasaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentangKami">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#f6f6f6" class="bi bi-door-open" viewBox="0 0 16 16">
                                <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1" />
                                <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117M11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="demo" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="4"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="5"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="6"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="7"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?= base_url('images/Burnout.jpeg') ?>" alt="Burnout" class="d-block w-100">
                    <div class="carousel-caption">
                        <h3>Burnout: Ketika Kelelahan Mental Menjadi Hambatan</h3>
                        <p>Burnout adalah kondisi kelelahan fisik, emosional, dan mental akibat tekanan pekerjaan atau tanggung jawab berlebih.
                            Tanda-tanda burnout termasuk kelelahan ekstrem, kehilangan motivasi, dan merasa tidak produktif meski telah bekerja keras.
                            Dengan mengenali gejalanya lebih awal, kita bisa mengambil langkah-langkah seperti istirahat, menjaga keseimbangan hidup,
                            dan meminta dukungan agar terhindar dari dampak negatif yang lebih serius.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('images/Loneliness.jpeg') ?>" alt="Loneliness" class="d-block w-100">
                    <div class="carousel-caption">
                        <h3>Kesepian: Memahami Perasaan yang Menghantui</h3>
                        <p>Kesepian adalah pengalaman emosional yang dapat dialami oleh siapa saja, meskipun dikelilingi oleh orang lain.
                            Hal ini dapat timbul dari perasaan terputus dari lingkungan sosial, kehilangan koneksi dengan teman, atau
                            bahkan ketidakmampuan untuk berkomunikasi dengan orang lain. Mempelajari kesepian penting untuk memahami dampaknya
                            terhadap kesehatan mental dan fisik kita, serta mencari cara untuk mengatasinya melalui dukungan sosial dan pengembangan
                            diri.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('images/Anxiety.jpeg') ?>" alt="Anxiety" class="d-block w-100">
                    <div class="carousel-caption">
                        <h3>Kecemasan: Menghadapi Perasaan Takut yang Berlebihan</h3>
                        <p>Kecemasan adalah perasaan ketakutan atau kekhawatiran yang sering muncul tanpa alasan yang jelas.
                            Ini bisa membuat seseorang merasa gelisah, tegang, atau khawatir tentang hal-hal sehari-hari.
                            Meskipun kecemasan adalah respons normal terhadap stres, jika berlebihan, bisa mengganggu kehidupan sehari-hari.
                            Memahami kecemasan penting untuk mengenali gejalanya dan mencari bantuan, sehingga kita dapat mengelola
                            perasaan ini dengan lebih baik dan meningkatkan kualitas hidup.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('images/Frustasi.jpeg') ?>" alt="Frustasi" class="d-block w-100">
                    <div class="carousel-caption">
                        <h3>Frustrasi: Ketika Harapan Tidak Sesuai Kenyataan</h3>
                        <p>Frustrasi adalah perasaan kesal atau kecewa yang muncul ketika sesuatu tidak berjalan sesuai harapan.
                            Hal ini bisa disebabkan oleh berbagai hal, seperti kegagalan mencapai tujuan atau hambatan yang muncul dalam perjalanan hidup.
                            Frustrasi adalah emosi yang normal, tetapi jika tidak dikelola dengan baik, dapat memengaruhi kesehatan mental dan fisik.
                            Memahami frustrasi dapat membantu kita menemukan cara untuk tetap tenang, bersabar, dan mencari solusi yang lebih efektif.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('images/Trauma.jpeg') ?>" alt="Trauma" class="d-block w-100">
                    <div class="carousel-caption">
                        <h3>Trauma: Luka Emosional yang Tersimpan di Dalam Diri</h3>
                        <p>Trauma adalah respons emosional terhadap peristiwa yang sangat mengejutkan atau menyakitkan, seperti kecelakaan,
                            kekerasan, atau kehilangan. Pengalaman ini bisa meninggalkan bekas yang mendalam dan mempengaruhi cara seseorang
                            memandang dunia serta dirinya sendiri. Trauma tidak selalu terlihat dari luar, namun dapat berdampak jangka panjang
                            pada kesehatan mental dan fisik. Memahami trauma adalah langkah penting untuk proses penyembuhan dan menemukan
                            dukungan yang dibutuhkan untuk pulih.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('images/Hopeless.jpeg') ?>" alt="Hopeless" class="d-block w-100">
                    <div class="carousel-caption">
                        <h3>Putus Asa: Saat Harapan Mulai Hilang</h3>
                        <p>Putus asa adalah perasaan kehilangan harapan atau keyakinan bahwa keadaan akan membaik.
                            Ini bisa muncul setelah mengalami kegagalan, kehilangan, atau situasi sulit yang tampaknya
                            tidak ada jalan keluarnya. Perasaan ini dapat membuat seseorang merasa terjebak dan tidak
                            mampu melihat kemungkinan perubahan positif. Penting untuk memahami bahwa meskipun putus asa
                            bisa sangat menyakitkan, ada cara untuk menemukan kembali harapan dengan dukungan dan langkah-langkah
                            kecil menuju pemulihan.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('images/Family & Relation.jpeg') ?>" alt="Family & Relation" class="d-block w-100">
                    <div class="carousel-caption">
                        <h3>Keluarga & Hubungan: Fondasi Penting dalam Kehidupan</h3>
                        <p>Keluarga dan hubungan merupakan pilar utama yang memberikan dukungan emosional, rasa aman, dan kebahagiaan dalam hidup.
                            Hubungan yang sehat dalam keluarga dan dengan orang lain membantu seseorang merasa dihargai dan dicintai.
                            Namun, seperti halnya semua hubungan, tantangan dan konflik bisa terjadi.
                            Memahami pentingnya komunikasi yang baik, empati, dan saling pengertian adalah kunci untuk membangun dan menjaga
                            hubungan yang harmonis dan kuat dalam keluarga dan lingkungan sosial.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('images/Jealousy.jpeg') ?>" alt="Jealousy" class="d-block w-100">
                    <div class="carousel-caption">
                        <h3>Cemburu: Mengelola Perasaan Iri yang Mengganggu</h3>
                        <p>Cemburu adalah emosi yang muncul ketika seseorang merasa takut kehilangan perhatian, cinta, atau kedudukan karena orang lain.
                            Perasaan ini bisa timbul dalam berbagai hubungan, baik itu pertemanan, keluarga, atau percintaan.
                            Meskipun wajar, cemburu yang berlebihan dapat merusak kepercayaan dan hubungan yang sehat.
                            Memahami cemburu membantu kita mengelola emosi ini dengan lebih baik dan memperkuat rasa percaya diri serta hubungan yang kita miliki.</p>
                    </div>
                </div>
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    <!-- Ruang Bercerita -->
    <div class="background-1" id="ruangCerita">
        <div class="container my-5">
            <h1 class="fw-bold text-center">Temukan Ruang yang Cocok Denganmu!</h1>

            <div class="row mt-5">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="card-img rounded-circle me-3" src="<?= base_url('images/Forum1.jpg') ?>">
                            </div>
                            <div class="col-md-8 align-self-center">
                                <h2 class="fw-bold">Never Alone</h2>
                                <p style="font-weight: 600;">Isolasi Sosial dan Kesepian</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="card-img rounded-circle me-3" src="<?= base_url('images/Forum2.jpg') ?>">
                            </div>
                            <div class="col-md-8 align-self-center">
                                <h2 class="fw-bold">You Strong</h2>
                                <p style="font-weight: 600;">Trauma dan Penyembuhan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="card-img rounded-circle me-3" src="<?= base_url('images/Forum3.jpg') ?>">
                            </div>
                            <div class="col-md-8 align-self-center">
                                <h2 class="fw-bold">Terus Bernapas!</h2>
                                <p style="font-weight: 600;">Tips dan Dukungan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="card-img rounded-circle me-3" src="<?= base_url('images/Forum4.jpg') ?>">
                            </div>
                            <div class="col-md-8 align-self-center">
                                <h2 class="fw-bold">Tempat Pulang!</h2>
                                <p style="font-weight: 600;">Tips dan Dukungan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary mt-3">Lihat Lebih Banyak</button>
            </div>
        </div>
    </div>

    <!-- Jejak Perasaan -->
    <div class="background-2" id="jejakPerasaan">
        <div class="container my-5">
            <h1 class="fw-bold text-center">Bagaimana Perasaanmu Hari Ini?</h1>

            <div class="row mt-5">
                <div class="col-md-3">
                    <div class="card green">
                        <div class="card-body">
                            <p class="card-text">Harus Pulang Kemana???</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-5">
                    <div class="card blue">
                        <div class="card-body">
                            <p class="card-text">Teruslah bernapas walau dunia selalu menolakmu</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card yellow">
                        <div class="card-body">
                            <p class="card-text">Aku sudah kehilangan semuanya</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-5">
                    <div class="card pink">
                        <div class="card-body">
                            <p class="card-text">Keluarga harusnya menjadi rumah yang nyaman, tapi bagiku tidak</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card pink2">
                        <div class="card-body">
                            <p class="card-text">AKU CAPEK...</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-5">
                    <div class="card purple">
                        <div class="card-body">
                            <p class="card-text">Melihat orang lain bahagia terasa menyenangkan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card green1">
                        <div class="card-body">
                            <p class="card-text">Tidak ada tempat lagi yang dapat aku sebut rumah</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-5">
                    <div class="card purple1">
                        <div class="card-body">
                            <p class="card-text">Apakah orang sepertiku pantas untuk bahagia??</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-primary mt-3">Ayo! Tinggalkan Jejak Perasaanmu</button>
            </div>
        </div>

    </div>

    <!-- Tentang Kami -->
    <div class="background-3" id="tentangKami">
        <div class="container my-5">
            <h1 class="fw-bold text-center">Tentang Kami</h1>

            <div class="row mt-5 header">
                <div class="col-md-6">
                    <h2>Selamat Datang di</h2>
                    <img src="<?= base_url('images/Logo Bercerita.com2.png') ?>" class="logo">
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <div class="row mt-3">
                    <div class="col-md-7">
                        <div class="body-text">
                            <p>
                                Bercerita.com adalah platform digital yang mendukung kesehatan mental, khususnya bagi kaum muda.
                                Kami menyediakan ruang aman dan anonim untuk berbagi cerita atau mencari dukungan,
                                dengan fitur konsultasi bersama psikolog profesional dan forum diskusi mahasiswa psikologi.
                                Layanan kami mencakup chat pribadi dengan psikolog, penjadwalan konsultasi luring,
                                serta Mading Notes Digital untuk mencatat perasaan secara bebas dalam perjalanan menuju kesejahteraan mental.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <img src="<?= base_url('images/elemenTentangKami.png') ?>" class="ilustrasi">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Home: Psikolog -->
    <div class="background-4" id="konsultasi">
        <div class="container my-5">
            <h1 class="fw-bold title text-center">Mau Mulai Konsultasi?</h1>
            <h1 class="fw-bold title text-center">Yuk Kenali Psikolog Kami!</h1>

            <div class="d-flex justify-content-center mt-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="<?= base_url('images/psikolog1.jpeg') ?>" alt="Card image">
                            <div class="card-img-overlay">
                                <h4 class="card-title">Alex Kurniawan M.Psi</h4>
                                <p class="card-text">Berpengalaman dalam menganani kasus terkait kecemasan dan gangguan depresi.</p>
                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-primary">Buat Janji</a>
                                    <a href="#" class="detail-link">Selengkapnya...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="<?= base_url('images/psikolog2.jpeg') ?>" alt="Card image">
                            <div class="card-img-overlay">
                                <h4 class="card-title">Nayara Karista M.Psi</h4>
                                <p class="card-text">Berpengalaman dalam menganani kasus terkait kecemasan dan gangguan depresi.</p>
                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-primary">Buat Janji</a>
                                    <a href="#" class="detail-link">Selengkapnya...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="<?= base_url('images/psikolog3.jpeg') ?>" alt="Card image">
                            <div class="card-img-overlay">
                                <h4 class="card-title">Anindya Mustika M.Psi</h4>
                                <p class="card-text">Berpengalaman menangani kasus terkait ggangguan Mood, Depresi, gangguan Kecemasan, gangguan kepribadian, serta Non Suicidal Self Injury.</p>
                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-primary">Buat Janji</a>
                                    <a href="#" class="detail-link">Selengkapnya...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-primary mt-3">Lihat Semua</button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <img src="<?= base_url('images/Logo Bercerita.com.png') ?>" alt="Bercerita.com">
        <p>Universitas Sanata Dharma Yogyakarta <br>
            Fakultas Sains & Teknologi <br>
            Kampus III <br>
            Paingan, Maguwoharjo, Kec.Depok <br>
            Daerah Istimewa Yogyakarta 55281 <br> </p>
    </div>
</body>

</html>
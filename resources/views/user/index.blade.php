@extends('user.layouts.layout')

@section('title', 'Beranda')

@section('homeAct', 'active')

@section('content')
<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                data-aos="fade-up" data-aos-delay="200">
                <h1>Halo, {{ Auth::user()->name }} 👋</h1>
                <h2>Jangan lupa kerjakan tes yang tersedia ya!</h2>
                <div class="d-flex justify-content-center justify-content-lg-start">
                    <a href="{{ route('user.tests') }}" class="btn-get-started scrollto">Kerjakan tes</a>
                    @if ($video->is_active)
                    <a href="{{ $video->value }}" class="glightbox btn-watch-video"><i
                            class="bi bi-play-circle"></i><span>Video Tutorial</span></a>
                    @endif
                </div>
            </div>
            <div class="col-lg-5 order-1 order-lg-2 hero-img ms-6 d-flex justify-content-center" data-aos="zoom-in"
                data-aos-delay="200">
                <img src="assets/img/seculify/logo_shine.png" class="img-fluid animated" alt="Seculify">
            </div>
        </div>
    </div>
</section>

<main id="main">
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Tentang Seculify</h2>
            </div>

            <div class="row content">
                <div class="col-lg-6">
                    <p>
                        Kami menyediakan solusi edukasi dan test keamanan digital yang dapat meningkatkan pemahaman
                        terhadap bahaya dunia digital.
                    </p>
                    <ul>
                        <li><i class="ri-check-double-line"></i> Kami melakukan pengujian phishing untuk
                            mengidentifikasi kerentanan keamanan yang ada dalam organisasi.
                        </li>
                        <li><i class="ri-check-double-line"></i> Kami kemudian akan mengembangkan program pelatihan yang
                            disesuaikan dengan hasil tes dan kebutuhan.
                        </li>
                        <li><i class="ri-check-double-line"></i> Setelah pelatihan selesai, ulangi eksperimen untuk
                            mengukur peningkatan kesadaran dan mengidentifikasi hasil yang lebih maksimal.
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0">
                    <p>
                        Kami menawarkan metode pelatihan yang interaktif dan dapat disesuaikan, memastikan efektivitas
                        dan keterlibatan maksimal dari peserta.
                    </p>
                    {{-- <a href="#" class="btn-learn-more">Selengkapnya</a> --}}
                </div>
            </div>

        </div>
    </section>

    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">

            <div class="row">
                <div class="col-lg-9 text-center text-lg-start">
                    <h3>Periksa Progres Kamu</h3>
                    <p>Silakan klik tombol 'Ke halaman tes' untuk pergi ke halaman tes.</p>
                </div>
                <div class="col-lg-3 cta-btn-container text-center">
                    <a class="cta-btn align-middle" href="{{ route('user.tests') }}">Ke halaman tes</a>
                </div>
            </div>

        </div>
    </section>

    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Frequently Asked Questions</h2>
                <p>Pertanyaan yang sering diajukan oleh pengguna Seculify.</p>
            </div>
            <div class="faq-list">
                <ul>
                    <li data-aos="fade-up" data-aos-delay="100">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse"
                            data-bs-target="#faq-list-1">Apa saja layanan yang ditawarkan oleh Seculify? <i
                                class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                            <p>
                                Kami menawarkan pelatihan keamanan digital, pengujian phishing, pengembangan program
                                pelatihan, dan evaluasi keamanan.
                            </p>
                        </div>
                    </li>
                    <li data-aos="fade-up" data-aos-delay="200">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                            data-bs-target="#faq-list-2" class="collapsed">Apa yang membedakan Seculify dari penyedia
                            pelatihan keamanan digital lainnya?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Seculify menggunakan metode pelatihan interaktif dan dapat disesuaikan, memastikan
                                efektivitas dan keterlibatan maksimal dari peserta. Kami juga menyediakan solusi yang
                                disesuaikan dengan kebutuhan klien.
                            </p>
                        </div>
                    </li>
                    <li data-aos="fade-up" data-aos-delay="300">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                            data-bs-target="#faq-list-3" class="collapsed">Apakah Seculify menawarkan layanan pelatihan
                            online atau offline?
                            <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Kami menyediakan pelatihan secara offline maupun online, yang dirancang untuk memberikan
                                fleksibilitas maksimal kepada peserta. Pelatihan online kami disesuaikan dengan
                                kebutuhan klien dan dapat diakses sesuai jadwal dan ketersediaan peserta.
                            </p>
                        </div>
                    </li>
                    <li data-aos="fade-up" data-aos-delay="400">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                            data-bs-target="#faq-list-4" class="collapsed">Bagaimana cara memulai menggunakan layanan
                            Seculify?<i class="bx bx-chevron-down icon-show"></i><i
                                class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Anda dapat menghubungi kami melalui situs web kami atau mengirimkan permintaan melalui
                                email.
                            </p>
                        </div>
                    </li>
                    <li data-aos="fade-up" data-aos-delay="500">
                        <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                            data-bs-target="#faq-list-5" class="collapsed">Bagaimana proses evaluasi dan peningkatan
                            berkelanjutan dilakukan oleh Seculify? <i class="bx bx-chevron-down icon-show"></i><i
                                class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                kami melakukan ulang eksperimen untuk mengukur peningkatan kesadaran dan
                                mengidentifikasi hasil yang lebih maksimal. Ini memungkinkan kami untuk terus
                                menyesuaikan program pelatihan kami sesuai kebutuhan klien.
                            </p>
                        </div>
                    </li>
            </div>
    </section>

    @php
    $qr_donasi = \App\Models\Config::where('key', 'qr_donasi')->first();
    @endphp

    @if ($qr_donasi->value != null && $qr_donasi->is_active == 1)
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Donasi Seculify</h2>
                <p>Terima kasih telah menggunakan layanan seculify.</p>
            </div>

            <div class="row">

                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="info">
                        <div class="qris">
                            {{-- <i class="bi bi-geo-alt"></i> --}}
                            <h3>QRIS:</h3>
                            <img style="max-width: 250px; margin-top: 12px;"
                                src="{{asset('storage/configs/'.$qr_donasi->value)}}" alt="qr_donasi" class="img-fluid">
                            {{-- <p></p> --}}
                        </div>

                        {{-- <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>info@example.com</p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p>+1 5589 55488 55s</p>
                        </div> --}}

                    </div>

                </div>

                {{-- <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Your Name</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Your Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Subject</label>
                            <input type="text" class="form-control" name="subject" id="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Message</label>
                            <textarea class="form-control" name="message" rows="10" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div> --}}

            </div>

        </div>
    </section><!-- End Contact Section -->
    @endif
</main>
@endsection
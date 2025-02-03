@extends('user.layouts.layout')

@section('title', 'Pengerjaan Tes')

@section('testAct', 'active')

@section('content')
<style>
    .question-content span.yes-click {
        cursor: pointer;
        text-decoration: underline;
        color: #47b2e4;
    }

    .popup {
        display: none;
        position: fixed;
        left: 10px;
        bottom: 10px;
        color: white;
        background-color: #151515;
        padding: 3px 5px;
        z-index: 1000;
        font-size: .8rem;
    }

    .no-click {
        pointer-events: none;
    }
</style>

<main id="main">
    <section id="portfolio" class="portfolio" style="margin-top: 100px">
        <div class="container">
            <div class="section-title">
                <h2>{{ $test->title }}</h2>
                <p>{{ $test->description }} ({{ $test->level }})</p>
            </div>
            <section id="faq" class="faq section-bg nomor-show">
                <div class="container col-12 col-md-8 col-lg-6" data-aos="fade-up">
                    <div class="faq-list">
                        <ul>
                            <li data-aos="fade-up" data-aos-delay="100">
                                <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse"
                                    data-bs-target="#faq-list-1">Nomor Soal <i
                                        class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                                    <p id="nomor-show">
                                    <ul id="portfolio-flters" class="d-flex justify-content-center">
                                        @foreach ($scores as $score)
                                        <li data-filter=".filter-{{ $loop->iteration }}" class="@if($score->is_done) filter-active done @endif">
                                            {{ $loop->iteration }}</li>
                                        @endforeach
                                    </ul>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
            </section>
            <div class="row portfolio-container d-flex justify-content-center">
                @foreach ($scores as $score)
                <div class="col-lg-12 col-md-12 portfolio-item filter-{{ $loop->iteration }}">
                    <div class="info">
                        <div class="address d-flex flex-column align-items-center">
                            <h6>{{ $score->question->title }}</h6>
                            <p style="margin-bottom: 8px; font-size: 16px;">{{$score->question->description}}</p>
                            <div id="question-content-{{ $loop->iteration }}" class="question-content">
                                @php echo nl2br($score->question->question_content) @endphp
                            </div>
                            {{-- <img style="height: 100%; max-height: 350px;"
                                src="{{Storage::url('quests/' . $score->question->image)}}" alt=""> --}}
                            <div class="buttons d-flex flex-column align-items-center justify-content-center mt-4">
                                <h6>Pilih Jawaban:</h6>
                                <div class="d-flex gap-2">
                                    <form
                                        action="{{ route('user.answer', ['score_id' => $score->id, 'answer' => 1, 'section' => $loop->iteration]) }}"
                                        method="post">
                                        @csrf
                                        @if ($score->is_done && $score->answer == 1)
                                        <button type="submit" class="btn btn-learn-more btn-answer selected">{{
                                            \App\Models\Config::where('key', 'yes_choice')->first()->value }}</button>
                                        @else
                                        <button type="submit" class="btn btn-learn-more btn-answer">{{
                                            \App\Models\Config::where('key', 'yes_choice')->first()->value }}</button>
                                        @endif
                                    </form>
                                    <form
                                        action="{{ route('user.answer', ['score_id' => $score->id, 'answer' => 0, 'section' => $loop->iteration]) }}"
                                        method="post">
                                        @csrf
                                        @if ($score->is_done && $score->answer == 0)
                                        <button type="submit" class="btn btn-learn-more btn-answer selected">{{
                                            \App\Models\Config::where('key', 'no_choice')->first()->value }}</button>
                                        @else
                                        <button type="submit" class="btn btn-learn-more btn-answer">{{
                                            \App\Models\Config::where('key', 'no_choice')->first()->value }}</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                            @if ($is_finish)
                            <div class="mt-4 div-finish">
                                <small>Anda telah menjawab semua pertanyan. Tekan selesai untuk mengakhiri tes.</small>
                                <button type="button" class="btn btn-learn-more finish mx-2" data-toggle="modal"
                                    data-target="#finish{{$score->id}}">Selesai</button>
                            </div>
                            <div class="modal fade" id="finish{{$score->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="deleteModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Selesai?
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center pt-3">
                                            <p>Yakin ingin mengakhiri tes?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <a href="{{ route('user.finish', $score->attempt_id) }}"
                                                class="btn btn-primary">Akhiri tes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection

@section('js')
<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script>
    window.addEventListener("load", () => {
        let portfolioContainer = document.querySelector(".portfolio-container");
        if (portfolioContainer) {
            let portfolioIsotope = new Isotope(portfolioContainer, {
                itemSelector: ".portfolio-item",
            });

            let portfolioFilters = document.querySelectorAll("#portfolio-flters li");

            portfolioFilters.forEach((filter) => {
                filter.addEventListener("click", function (e) {
                    e.preventDefault();
                    portfolioFilters.forEach((el) => {
                        el.classList.remove("filter-active");
                    });
                    this.classList.add("filter-active");

                    portfolioIsotope.arrange({
                        filter: this.getAttribute("data-filter"),
                    });
                    portfolioIsotope.on("arrangeComplete", function () {
                        AOS.refresh();
                    });
                });
            });
            let defaultFilter = document.querySelector("[data-filter='.filter-{{$done > 0 ? $done : 1}}']");
            if (defaultFilter) {
                defaultFilter.click();
            }
        }
    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const popup = document.createElement('div');
        popup.className = 'popup';
        document.body.appendChild(popup);

        document.querySelectorAll('[id^="question-content"]').forEach(questionContent => {
            // Replace <a> with <span>
            const links = questionContent.querySelectorAll('a');
            links.forEach(link => {
                const span = document.createElement('span');
                span.textContent = link.textContent;
                span.dataset.href = link.getAttribute('href');
                span.className = link.className+' yes-click';
                link.parentNode.replaceChild(span, link);
            });

            questionContent.addEventListener('mouseover', function(event) {
                if (event.target.tagName.toLowerCase() === 'span' && event.target.dataset.href) {
                    popup.textContent = event.target.dataset.href;
                    popup.style.display = 'block';
                    event.target.classList.add('no-click');
                }
            });

            questionContent.addEventListener('mouseout', function(event) {
                if (event.target.tagName.toLowerCase() === 'span' && event.target.dataset.href) {
                    popup.style.display = 'none';
                    event.target.classList.remove('no-click');
                }
            });

            questionContent.addEventListener('click', function(event) {
                if (event.target.tagName.toLowerCase() === 'span' && event.target.dataset.href) {
                    event.preventDefault();
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    const portfolioFilters = document.querySelectorAll("#portfolio-flters li");
    const portfolioContainer = document.querySelector(".portfolio-container");

    if (portfolioContainer) {
        let portfolioIsotope = new Isotope(portfolioContainer, {
            itemSelector: ".portfolio-item",
        });

        dropdownItems.forEach(item => {
            item.addEventListener('click', function (e) {
                e.preventDefault();
                portfolioIsotope.arrange({
                    filter: this.getAttribute("data-filter"),
                });
            });
        });

        portfolioFilters.forEach((filter) => {
            filter.addEventListener("click", function (e) {
                e.preventDefault();
                portfolioFilters.forEach((el) => {
                    el.classList.remove("filter-active");
                });
                this.classList.add("filter-active");

                portfolioIsotope.arrange({
                    filter: this.getAttribute("data-filter"),
                });
            });
        });
    }
});

</script>
@endsection

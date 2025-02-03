@extends('user.layouts.layout')

@section('title', 'Pengerjaan Tes')

@section('testAct', 'active')

@section('content')
<style>
    #question-content span.yes-click {
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
                <h2>Review {{ $attempt->test->title }}</h2>
                <p class="mb-1">Jawaban benar: <i>{{ $corrects }} dari {{ $totals }} pertanyaan</i></p>
                <p>Diselesaikan pada: <i>{{ $attempt->updated_at }}</i></p>
            </div>
            <ul id="portfolio-flters" class="d-flex justify-content-center">
                @foreach ($attempt->scores as $score)
                <li data-filter=".filter-{{ $loop->iteration }}" class="@if($score->is_correct) filter-active done @else wrong @endif">{{ $loop->iteration }}</li>
                @endforeach
            </ul>
            <div class="row portfolio-container d-flex justify-content-center">
                @foreach ($attempt->scores as $score)
                <div class="col-lg-12 col-md-12 portfolio-item filter-{{ $loop->iteration }}">
                    <div class="info">
                        <div class="address d-flex flex-column align-items-center">
                            <h6>{{ $score->question->title }}</h6>
                            <p style="margin-bottom: 8px; font-size: 16px;">{{$score->question->description}}</p>
                            <div id="question-content">
                                @php echo nl2br($score->question->question_content) @endphp
                            </div>
                            {{-- <img style="height: 100%; max-height: 350px;"
                                src="{{Storage::url('quests/' . $score->question->image)}}" alt=""> --}}
                            <div class="proof @if($score->is_correct) correct @else wrong @endif">
                                <h5>Jawaban Anda <b>@if($score->is_correct) Benar @else Salah @endif</b></h5>
                                <p>{{$score->question->proof}}</p>
                            </div>
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
            // Select the filter with the class 'data-filter-1' and simulate a click
            let defaultFilter = document.querySelector("[data-filter='.filter-1']");
            if (defaultFilter) {
                defaultFilter.click();
            }
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const questionContent = document.getElementById('question-content');
        const popup = document.createElement('div');
        popup.className = 'popup';
        document.body.appendChild(popup);

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
</script>
@endsection

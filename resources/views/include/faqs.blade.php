@php
$get_city_faq = DB::table('city_faq')
->get();
@endphp
<!-- faqs -->
<section class="section-5 padding">
    <div class="label">
        <h3 class="text-center fw-bold mb-5">
            Frequently Asked Questions (FAQs)
        </h3>
    </div>
    <div class="accordion" id="accordionExample">
        @foreach ($get_city_faq as $faq) 
            <div class="accordion-item">
                <h2 class="accordion-header mb-2" id="headingTwo">
                    <button class="accordion-button shadow-none collapsed rounded-4 d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <div class="d-flex align-items-center">
                            <img src="{{asset('assets/website-images/Q.png')}}" alt="q" />
                            <strong>
                                <p class="ms-3">
                                    {{$faq->city_faq_que}}
                                </p>
                            </strong>
                        </div>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body d-flex align-items-start rounded-4">
                        <img src="{{asset('assets/website-images/A.png')}}" alt="a" />
                        <p class="ms-3">
                            {{$faq->city_faq_ans}}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach    
    </div>
</section>

<!-- faqs -->
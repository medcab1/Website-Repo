@php
$get_city_faq = DB::table('city_faq')
->get();
@endphp
<!-- faqs -->
<section class="section-5 d-flex flex-column gap-5 padding">
    <div class="label">
        <h3 class="text-center fw-bold mb-5">
            Frequently Asked Questions (FAQs)
        </h3>
    </div>
    <div class="accordion" id="accordionExample">
        <?php for ($i = 0; $i < 5; $i++) { ?>
            <div class="accordion-item mb-4">
                <h2 class="accordion-header" id="heading{{$i+1}}">
                    <button onclick="setBorder(<?php echo $i ?>)" class="accordion-button shadow-none collapsed rounded-4 d-flex justify-content-between" id="<?php echo $i ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$i+1}}" aria-expanded="false" aria-controls="collapse{{$i+1}}">
                        <div class="d-flex align-items-center">
                            <img src="{{asset('assets/website-images/Q.png')}}" alt="q" />
                            <strong>
                                <p class="ms-3">
                                    {{$get_city_faq[$i]->city_faq_que}}
                                </p>
                            </strong>
                        </div>
                    </button>
                </h2>
                <div id="collapse{{$i+1}}" class="accordion-collapse collapse" aria-labelledby="heading{{$i+1}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body d-flex align-items-start rounded-bottom-4">
                        <img src="{{asset('assets/website-images/A.png')}}" alt="a" />
                        <p class="ms-3">
                            {{$get_city_faq[$i]->city_faq_ans}}
                        </p>

                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<!-- faqs -->

<script>
    const setBorder = (id) => {
        console.log(id);

        var acc_btns = document.querySelectorAll('.accordion-button');

        var accordion_btn = document.getElementById(id);


        acc_btns.forEach(element => {

            console.log(element.getAttribute('id'))

            if (element.getAttribute('id') == id) {
                console.log('hey');
                if (element.classList.contains('rounded-4')) {
                    element.classList.remove('rounded-4');
                    element.classList.add('rounded-top-4');
                } else {
                    element.classList.remove('rounded-top-4');
                    element.classList.add('rounded-4');
                }
            } else {
                element.classList.remove('rounded-top-4');
                element.classList.add('rounded-4');
            }
        });





    }
</script>
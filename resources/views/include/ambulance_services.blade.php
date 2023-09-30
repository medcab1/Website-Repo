<!-- ambulance services -->
@php
$get_ambulance_categories = DB::table('ambulance_category')
->get();
@endphp
<section class="ourServices d-flex flex-column align-items-center">

    <section class="ambulance-services section-3 d-flex flex-column align-items-center padding">

        <div class="label">
            <h3 class="text-center fw-bold">Ambulance Services</h3>
        </div>
        <div class="content px-md-5 w-100 d-flex gap-5 mt-5 mb-5">

            <!-- ambulance cards -->
            <div class="left-content w-50">
                <?php $i = 1 ?>
                @foreach($get_ambulance_categories as $category)
                <div class="ambuCard d-flex flex-column justify-content-between align-items-center text-center justify-content-around gap-3 py-4 py-sm-3 rounded-5 bg-white" id="<?php echo $i ?>" onclick="cardClick(<?php echo $i++ ?>)">
                    <!-- Wrap both image and category name in an anchor tag -->
                    <a href="javascript:void(0);" class="category-link" data-category-id="{{ $category->ambulance_category_name }}">
                        <div class="ambuImage d-flex align-items-center justify-content-center">
                            <img src="{{ env('DYNAMIC_IMAGE_URL') . '/' . $category->ambulance_category_icon }}" alt="ambulance" />
                        </div>
                        <p class="mt-3">{{ $category->ambulance_category_name }}</p>
                    </a>
                </div>
                @endforeach
            </div>


            <!-- card data -->
            <div id="data-container" class="right-content w-50 rounded-4 d-flex flex-column justify-content-evenly gap-4" class="hide-div">
                <div class="bg-white rounded-4 py-4 px-2">
                    <div class="one d-flex flex-column align-items-center">
                        <img id="category-image" src="{{asset('assets/website-images/Component 11-2.png')}}" alt="" />
                        <h4 class="fw-bold text-center" id="category-title">Medical First Responder</h4>
                    </div>
                    <div class="two">
                        <p class="text-center" id="category-description">
                            Medical First Responder (MFR) ambulances are the first
                            responders to any medical emergency. They are equipped with
                            basic medical equipments and trained medical personnel to
                            stabilize patients until more advanced care arrives.
                        </p>
                    </div>
                    <div class="three" id="category-kits">
                        <div id="category-kit-0" class="d-flex flex-column align-items-center">
                            <img id="kit-image-0" class="mb-2 kit-image" src="{{asset('assets/website-images/suitcase.png')}}" alt="" />
                            <h4 id="kit-name-0" class="secondary-text kit-name primary-text">Emergency Kit</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="download-button d-flex justify-content-center">
            <a href="#" class="text-decoration-none shadow-lg my-2 primary-cta text-white">Download MedCab App</a>
        </div>
    </section>
</section>

<!-- ambulance services -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- active button script -->
<script>
    const cardClick = (id) => {

        var cards = document.querySelectorAll('.ambuCard');
        cards.forEach(element => {
            element.style.border = "none";
        });

        console.log(id);
        var card = document.getElementById(id);
        card.style.border = "1px solid #159D89";
    }
</script>
<!-- active button script -->


<script>
    var ambulanceRoute = "{{ route('get-ambulance') }}"; // Define the route URL in your Blade template
    $(document).ready(function() {




        $('.category-link').on('click', function(e) {
            e.preventDefault();
            // Get the category ID from the data attribute
            var categoryId = $(this).data('category-id');



            // Get the CSRF token from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Make an AJAX POST request with the ambulanceRoute
            $.ajax({
                type: 'POST',
                url: ambulanceRoute, // Use the route URL variable here
                data: JSON.stringify({
                    categoryId: categoryId,
                    _token: csrfToken
                }),
                dataType: 'json',
                contentType: 'application/json',
                success: function(response) {
                    // console.log('Response (success):', response);

                    // Access the category data and emergency kits
                    var categoryData = response.category_data;
                    var emergencyKits = response.emergency_kits;

                    // console.log(emergencyKits.length);

                    // Update your existing HTML elements with the retrieved data
                    $('#category-title').text(categoryData.category_name);
                    $('#category-image').attr('src', categoryData.category_image);
                    // $('#category-description').text(categoryData.category_desc);

                    // Iterate through the emergency kits and update your HTML elements accordingly
                    var thelist = document.getElementById("category-kits");
                    while (thelist.hasChildNodes()) {
                        thelist.removeChild(thelist.lastChild);
                    }



                    $.each(emergencyKits, function(index, kit) {
                        // Update existing HTML elements with the data


                        var image = $("<img>", {
                            id: "kit-image-" + index,
                            class: "mb-2 kit-image",
                            src: ""
                        });
                        var head = $("<h4>", {
                            id: "kit-name-" + index,
                            class: "kit-name primary-text secondary-text"
                        });

                        var category_kit = $("<div>", {
                            id: "category-kit-" + index,
                            class: "d-flex flex-column align-items-center"
                        });
                        $('#category-kits').append(category_kit);

                        $('#category-kit-' + index).append(image);
                        $('#category-kit-' + index).append(head);


                        // console.log(category_kit)

                        $('#kit-image-' + index).attr('src', kit.emergency_kit_image);
                        $('#kit-name-' + index).text(kit.emergency_kit);
                    });

                    // Remove the 'd-none' class to show the data container
                    $('#data-container').removeClass('d-none');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>
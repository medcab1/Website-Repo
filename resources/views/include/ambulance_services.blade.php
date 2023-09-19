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
            <div class="left-content w-50">
                @foreach($get_ambulance_categories as $category)
                <div class="ambuCard d-flex flex-column justify-content-between align-items-center text-center justify-content-around gap-3 py-4 py-sm-3 rounded-4 bg-white">
                    <!-- Wrap both image and category name in an anchor tag -->
                    <a href="javascript:void(0);" class="category-link" data-category-id="{{ $category->ambulance_category_name }}">
                        <div class="ambuImage d-flex align-items-center justify-content-center">
                            <img src="{{ env('DYNAMIC_IMAGE_URL') . '/' . $category->ambulance_category_icon }}" alt="ambulance" />
                        </div>
                        <p>{{ $category->ambulance_category_name }}</p>
                    </a>
                </div>
                @endforeach
            </div>
            @if(!empty($ambulanceData))
            <div id="data-container" class="right-content w-50 rounded-4 d-flex flex-column justify-content-evenly gap-4">
                <div class="bg-white rounded-4 py-4 px-2">

                    <div class="one d-flex flex-column align-items-center">
                        <img src="{{ asset($ambulanceData->ambulance_category_icon) }}" alt="" />
                        <h4 class="fw-bold text-center">{{ $ambulanceData->ambulance_category_name }}</h4>
                    </div>
                    <div class="two">
                        <p class="text-center">
                            {{$ambulanceData->ambulance_catagory_desc}}
                        </p>
                    </div>
                    <div class="three">
                        <!-- Loop through any additional data you have -->
                        <div class="card-three cardAmbu d-flex flex-column align-items-center justify-content-center">
                            <img class="mb-sm-2" src="{{ asset($ambulanceData->ambulance_facilities_image) }}" alt="" />
                            <p class="text-center">{{ $ambulanceData->ambulance_facilities_name }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @else
            <div id="data-container" class="right-content w-50 rounded-4 d-flex flex-column justify-content-evenly gap-4">
                <div class="bg-white rounded-4 py-4 px-2">
                    <div class="one d-flex flex-column align-items-center">
                        <img src="{{asset('assets/website-images/Component 11.png')}}" alt="" />
                        <h4 class="fw-bold text-center">Medical First Responder</h4>
                    </div>
                    <div class="two">
                        <p class="text-center">
                            Medical First Responder (MFR) ambulances are the first
                            responders to any medical emergency. They are equipped with
                            basic medical equipments and trained medical personnel to
                            stabilize patients until more advanced care arrives.
                        </p>
                    </div>
                    <div class="three">
                        <div class="card-three cardAmbu d-flex flex-column align-items-center justify-content-center">
                            <img class="mb-sm-2" src="{{asset('assets/website-images/suitcase.png')}}" alt="" />
                            <p class="text-center">Emergency Kit</p>
                        </div>
                        <div class="card-three cardAmbu d-flex flex-column align-items-center justify-content-center">
                            <img class="mb-2" src="{{asset('assets/website-images/Multipara monitor.png')}}" alt="" />
                            <p class="text-center">Emergency Kit</p>
                        </div>
                        <div class="card-three cardAmbu d-flex flex-column align-items-center justify-content-center">
                            <img class="mb-2" src="{{asset('assets/website-images/oxygen.png')}}" alt="" />
                            <p class="text-center">Emergency Kit</p>
                        </div>
                        <div class="card-three cardAmbu d-flex flex-column align-items-center justify-content-center">
                            <img class="mb-2" src="{{asset('assets/website-images/stretcher.png')}}" alt="" />
                            <p class="text-center">Emergency Kit</p>
                        </div>
                        <div class="card-three cardAmbu d-flex flex-column align-items-center justify-content-center">
                            <img class="mb-2" src="{{asset('assets/website-images/wheelchair.png')}}" alt="" />
                            <p class="text-center">Emergency Kit</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="download-button d-flex justify-content-center">
            <a href="#" class="text-decoration-none shadow-lg my-2 primary-cta text-white">Download MedCab App</a>
        </div>
    </section>
</section>

<!-- ambulance services -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.category-link').on('click', function(e) {
            e.preventDefault();
            // Get the category ID from the data attribute
            var categoryId = $(this).data('category-id');

            // Get the CSRF token from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Make an AJAX POST request
            $.ajax({
                type: 'POST', // Change to POST
                url: '{{ route("get-ambulance") }}', // Use the route name for the POST route
                data: JSON.stringify({
                    categoryId: categoryId,
                    _token: csrfToken // Include the CSRF token
                }),
                dataType: 'json', // Set the expected response data type
                contentType: 'application/json', // Set the content type for the request
                success: function(response) {
                    console.log('Response (success):', response);

                    // Clear existing content in the data-container
                    $('#data-container').empty();


                    
                    // Iterate through the response data
                    // Iterate through the response data
                    response.forEach(function(item) {
                        // Create a new element for each item
                        var newItem = $('<div>').addClass('item');
                        var title = $('<h4>').text(item.ambulance_category_name);

                        // Access and display other properties by referencing them from the 'item' object
                        var description = $('<p>').text(item.ambulance_catagory_desc);
                        var category_image = $('<img>').attr('src', item.ambulance_category_icon).attr('alt', '');
                        var emergency_kit = $('<p>').text(item.ambulance_facilities_name);
                        var emergency_kit_icon = $('<img>').attr('src', item.ambulance_facilities_image).attr('alt', '');

                        // Append title, description, and images to the new item
                        newItem.append(category_image, title, description, emergency_kit_icon, emergency_kit);

                        // Append the new item to the data container
                        $('#data-container').append(newItem);
                    });

                },

                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>
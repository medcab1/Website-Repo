<!-- review data -->
<?php
$t_name = [
  0 => '- Zakir Khan',
  1 => '- Manisha Dharmik',
  2 => '- Kajal',
  3 => '- Ayushi Negi',
  4 => '- Aadesh Yadav',
  5 => '- Praveen Kumar',
  6 => '- Saurabh Awasthi',
];
$t_img = [
  0 => 'assets/image/zakir.jpeg',
  1 => 'assets/image/manisha.jpeg',
  2 => 'assets/image/kajal.jpeg',
  3 => 'assets/image/ayushi.jpeg',
  4 => 'assets/image/aadesh.jpeg',
  5 => 'assets/image/praveen.jpeg',
  6 => 'assets/image/saurabh.jpeg'
];
$t_desc = [
  0 => "Calling MedCab's ambulance was the best decision I made when my mother-in-law had
        sudden inhaling issues. Their team was well-trained and equipped to handle medical
        emergencies and they arrived at our doorstep within minutes. Thanks to their
        top-notch service, my mother-in-law got timely medical care, which saved her life.",
  1 => "MedCab's ambulance service is a lifesaver. When my brother met with a bike accident, I
        immediately called them and their team arrived shortly.  Thanks to their exceptional service, my brother received the medical attention he
        needed, which was crucial to his recovery.",
  2 => 'I recommend MedCab for its unmatched patient transport ambulance service. When I needed
        to take my mother to the hospital, their team was there for us. They arrived on time and
        provided us with excellent service. Their staff took great care of my mother throughout the
        journey. Thank you MedCab! ',
  3 => "I recently booked MedCab's ambulance service to transport my friend with walking disability
        and I was blown away by their fast service and professional attitude. The paramedics were
        patient and attentive and they went above and beyond to ensure the patient's comfort and
        safety during the journey.",
  4 => "MedCab's ambulance service is simply outstanding. I booked their service when my colleague
        had an accident and their team was there for us in a flash. The ambulance was well maintained
        and equipped. Thanks to their prompt service, my colleague received timely help. I highly
        recommend to go for MedCab ambulance in any emergency",
  5 => "MedCab's ambulance service is simply outstanding. I booked their service when my colleague
        had an accident and their team was there for us in a flash. The ambulance was well maintained
        and equipped. Thanks to their prompt service, my colleague received timely help. I highly
        recommend to go for MedCab ambulance in any emergency",
  6 => "The MedCab team demonstrated true professionalism and empathy throughout our journey to the hospital. Their staff went above and beyond in taking care of my loved one, providing reassurance and comfort during a stressful time. MedCab's dedication to patient care truly shone through."

];
?>

<!-- review data -->


<!-- Reviews Section -->
<section class="reviews w-100">
  <h1 class="main-heading">Reviews</h1>
  <div class="reviews-carousel owl-carousel-reviews owl-theme owl-carousel">
    <?php $i = 0;
      while ($i <= 6) {?>
    <div class="item">
      <div class="image"><img src="{{ asset($t_img[$i]) }}" alt="images">
      </div>
      <div class="reviews-content secondary-text">
        <p class="mt-4">
          {{$t_desc[$i]}}
        </p>
        <p class="mt-4">~ {{$t_name[$i]}}</p>
      </div>
    </div>
    <?php $i++; } ?>
  </div>
</section>

<!-- Reviews section -->
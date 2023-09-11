@extends('layouts.adminlayout')
@section('title',"Customer Cancellation & Refund Policy | MedCab")
@section('description',"MedCab Cancellation & Refund Policy- Cancellation fee exists to compensate drivers for their time and commitment.")
@section('keywords',"MedCab Customer Ambulance Cancellation, MedCab Customer Ambulance Refund Policy, MedCab Customer Cancellation & Refund Policy , Cancellation Charges")
@section('main')

<style>
    .text-section>ul>li {
        list-style: disc !important;
        margin-bottom: .5rem;
    }

    @media all and (max-width: 540px) {
        .text-section>ul>li {
            list-style: disc !important;
            margin-bottom: 1rem;
            border-bottom: 2px dashed var(--bs-gray-600);
            padding-bottom: 0.5em;
        }
    }
</style>
<!-- Cancellation and refund policy section  start-->
<section class="header-top-margin py-5">
    <div class="container">
        <h1 class="main-heading text-center mb-2">
            Customer Cancellations & Refund Policy
        </h1>
        <div class="text-section secondary-text">
            <p class="fs-3 text-center">
                Cancellations can be frustrating for riders and driver partners alike, which is why the cancellation fee is in place to ensure that drivers are fairly compensated for their time when committing to a trip. <br />
                <br />
            </p>
            <strong class="fs-2 p-heading">Liability:</strong>
            <p class="p-text">

                In the event of circumstances beyond our control, Med Cab reserves the right to cancel all services. Where payment has been made, a refund will be issued. If a Ambulance breaks down during the journey, an alternative will be provided with a practical time allowance.

                <br />
                <br />
                All cancellations of local journeys made before the booking time and prior to vehicle dispatch will not incur a penalty charge.

                If you cancel within 5 minutes: You will not be charged a cancellation fee.

                If you cancel after 5 minutes: The cancellation fee for a canceled trip will automatically be charged to your next trip.

                Before you cancel a trip, you will receive a notification to ensure that you are aware of the fee that will be deducted from your wallet.

                No refunds will be given for journeys terminated part way.

                If you have canceled multiple trips consecutively, the cancellation fees for the multiple trips will accumulate as arrears and prevent any more requests from going through. In such cases, you’re expected to clear the arrears using an alternative payment method, such as a credit, debit Ambulances, etc. Once the payments in arrears have been cleared, you will be able to request an Med Cab as usual.
                <br />
                <br />
                <strong class="fs-2 p-heading">Cancellation Fees:</strong>
                For the purposes of this Privacy Policy:<br />
            <ul>
                <li><b>BLS:</b> 10% of Booking Amount</li>
                <li><b>OTHERS:</b> 10% of Booking Amount</li>
                <li><b>ALS:</b> 10% of Booking Amount</li>

            </ul><br />
            If you feel that a cancellation fee has been unfairly charged, please use the in-app Help feature (from the menu located on the top left corner of the Med Cab app) to bring the particular trip to our attention. Optionally, please tell us why you’re requesting a Refund; we take customer feedback very seriously and use it to constantly improve our offering and quality of service.
            <br />
            <br />
            In order to receive a refund, please call our Support Team at . On approval, your refund will be initiated as per the given timelines. After we receive your refund request, our team of professionals will inspect it and process your refund. The money will be refunded to the original payment method you’ve used during the purchase. If your return is approved, we will initiate a refund to original method of payment. You will receive the credit within a certain amount of days, depending on your Ambulances issuer’s policies.
            If anything is unclear or you have more questions feel free to contact our Support team.
            <br />
            <br />
            <b class="fs-2 p-heading">Refund Timelines:</b>
            The refund time period for different modes of payments are provided below.<br />
            <br />
            <table style="border:none;">
                <tr>
                    <th class="pe-5">Mode </th>
                    <th> Duration</th>
                </tr>
                <tr>
                    <td class="pe-5">Med Cab Wallet**</td>
                    <td> 2 Hours</td>
                </tr>
                <tr>
                    <td class="pe-5">Credit Ambulanced/Debit Ambulanced</td>
                    <td> 2 – 7 Business Days</td>
                </tr>
                <tr>
                    <td class="pe-5">Net Banking (Credited to Bank Account) </td>
                    <td> 2 – 7 Business Days</td>
                </tr>
                <tr>
                    <td class="pe-5">UPI Linked Bank Account</td>
                    <td> 2 – 7 Business Days</td>
                </tr>
                <tr>
                    <td class="pe-5">Cash (Credited to Bank Account)</td>
                    <td> 2 – 7 Business Days</td>
                </tr>
            </table>
            </p><br />
            <span class="text-center my-3 d-block">Med Cab Wallet isn’t available at this time but will be added soon.</span>
        </div>
    </div>
</section>
<!-- Cancelation and refund policy section End -->

@endsection
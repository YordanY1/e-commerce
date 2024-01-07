<div>
    <p>Checkout Form!</p>
    <form action="/payment/checkout" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="address" placeholder="Address">
        <input type="text" name="city" placeholder="City">
        <input type="text" name="postal_code" placeholder="Postal Code">
        <input type="text" name="phone" placeholder="Phone">
        <input type="text" name="country" placeholder="Country">
        <input type="radio" name="client_type" value="personal">Personal
        <input type="radio" name="client_type" value="business">Business
        <input type="text" name="business_name" placeholder="Business Name">
        <input type="text" name="business_vat_number" placeholder="Business VAT Number">
        <input type="text" name="business_address" placeholder="Business Address">
        <input type="text" name="business_city" placeholder="Business City">
        <input type="text" name="business_postal_code" placeholder="Business Postal Code">
        <input type="text" name="business_phone" placeholder="Business Phone">
        <input type="text" name="business_country" placeholder="Business Country">
        <input type="submit" value="Submit">
    </form>
</div>
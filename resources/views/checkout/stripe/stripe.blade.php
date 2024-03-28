<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>General Stripe Charge</title>
    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container text-center">
        <form action="/stripe/charge" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-12">
                    <label for="amount">
                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount">
                    </label>
                    <label for="email">
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                    </label>
                    <br>
                    <label for="card-element">
                        Credit/Debit card
                    </label>
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>

                    <button type="submit">Submit Payment</button>
                </div>
            </div>
        </form>
        <script>
             var stripe = Stripe('{{ env("STRIPE_KEY") }}');
             var elements = stripe.elements();
         
             var card = elements.create('card', {
               style: {
                 base: {
                   iconColor: '#666EE8',
                   color: '#31325F',
                   lineHeight: '40px',
                   fontWeight: 300,
                   fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                   fontSize: '15px',
         
                   '::placeholder': {
                     color: '#CFD7E0',
                   },
                 },
               }
             });
             card.mount('#card-element');
         
             function setOutcome(result) {
               var successElement = document.querySelector('.success');
               var errorElement = document.querySelector('.error');
               successElement.classList.remove('visible');
               errorElement.classList.remove('visible');
         
               if (result.token) {
                 // Use the token to create a charge or a customer
                 // https://stripe.com/docs/charges
                 successElement.querySelector('.token').textContent = result.token.id;
                 successElement.classList.add('visible');
               } else if (result.error) {
                 errorElement.textContent = result.error.message;
                 errorElement.classList.add('visible');
               }
             }
         
             card.on('change', function(event) {
               setOutcome(event);
             });
         
             document.querySelector('form').addEventListener('submit', function(e) {
               e.preventDefault();
               var form = document.querySelector('form');
               var extraDetails = {
                 name: form.querySelector('input[name=cardholder-name]').value,
               };
               stripe.createToken(card, extraDetails).then(setOutcome);
             });
          </script>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
     <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
  <script type="text/javascript"  src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{ config('midtrans.client_key') }}"></script>

    <title>Checkout</title>
</head>
<body>
    <div class="d-flex pt-5 justify-content-center">
        <div style="text-align:center;width:300px; border: 1px solid black; border-radius:10px; padding:15px 20px;">
            <h2>{{ $order->id_invoice }}</h2>
            <p>Nama Tiket : {{ $namaTiket }}</p>
            <p>Quantity : {{ $order->quantity }}</p>
            <p>Total : Rp {{ formatUang($order->total) }}</p>
            <button style="width: 70%" class="btn btn-success" id="pay-button">Pay</button>
        </div>
    </div>
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
          window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
              alert("payment success!"); console.log(result);
            },
            onPending: function(result){
              alert("wating your payment!"); console.log(result);
            },
            onError: function(result){
              alert("payment failed!"); console.log(result);
            },
            onClose: function(){
              alert('you closed the popup without finishing the payment');
            }
          })
        });
      </script>
</body>
</html>
<head>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    
    <link rel="stylesheet" href="assets/css/templatemo-lava.css">
    
    <link rel="stylesheet" href="assets/css/owl-carousel.css">
    <link rel="stylesheet" href="assets/css/timeline.css">
</head>
<h1>Welcome, {{ $name }}!</h1>
<p>Thanks for your interest in {{ env('APP_NAME') }}. We’re thrilled to know that you want to join us.</p>
<p>To confirm waitlist, kindly click the button below to confirm your email address:</p>
<!-- Action -->
<table class="table table-responsive" align="center" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">
      <!-- Border based button https://litmus.com/blog/a-guide-to-bulletproof-buttons-in-email-design -->
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center">
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="center">
                  <a href="{{ $url }}" class="btn btn-lg bg-dark" style="color: white; background-color: blueviolet; padding: 10px; text-transformation: none" target="_blank">Confirm Email</a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<p>If you have any questions, feel free to <a href="mailto:support@ajirapay.finance">email our customer support team</a></p>
<p>Thanks,
  <br>{{ env('APP_NAME') }} Team</p>
<!-- Sub copy -->
<table class="body-sub">
  <tr>
    <td>
      <p class="sub">If you’re having trouble with the button above, copy and paste the URL below into your web browser.</p>
      <p class="sub">{{$url}}</p>
    </td>
  </tr>
</table>
<script src="assets/js/jquery-2.1.0.min.js"></script>

<!-- Bootstrap -->
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- Plugins -->
<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/scrollreveal.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/imgfix.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script> 
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script> 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 

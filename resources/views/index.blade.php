<!doctype html>
<html class="h-100" lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('images/cso_favicon.png')}}" />
    <title>{{ config('app.name', 'CSO Academy') }}</title>
    <link href="{{asset('vue/css/app.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/global.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta property="og:site_name" content="CSO Academy">
    <meta property="og:title" content="CSO Academy">
    <meta property="og:description" content="CSO Academy ကို CSO များမှ မြန်မာနိုင်ငံရှိအဖွဲ့အစည်းများ​၏ လူထုအသိုင်းဝိုင်းသို့ လိုအပ်သည့်အကူညီအထောက်ပံ့များပေ">
    <meta property="og:url" content="{{ asset('images/social_share_cso.png') }}">
    <meta property="og:image:alt" content="CSO Academy">

</head>

<body class="with-background d-flex flex-column">
    <div id="app" class="d-flex h-100">
    </div>
    <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
    </script>
    <script src="{{asset('vue/js/app.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
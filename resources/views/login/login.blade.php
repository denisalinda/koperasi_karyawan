<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/login.css">
    <link rel="stylesheet" href="/assets/aos/dist/aos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
</head>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<body class="bg-image " style="background-image: url({{url('image/galaxy-11098.jpg')}})">
    <div class="container " style="margin-top: 100px">
        <div class="row">
            <div class="col-md-4"></div>
            @if (session()->has('captcha'))
        
            <div  data-aos="fade-down-right" class="col-md-4 mb-4">
              <div class="alert alert-danger text-center" role="alert">
                {{session('captcha')}}
              </div>
        @endif
     

            <div class="d-flex justify-content-center">
                <div class="card" style="width: 25rem;">
                    <ul class="list-group list-group-flush">
                     
                      <li class=" list-group-item text-center font-login-judul pt-3">Login 
                  
                      </li>
                      <li class="list-group-item mt-3">
                        <form action="/login" method="post">
                          @csrf
                          <div class="form-group">
                            <label for="email active">Email</label>
                            <input type="email" required class="form-control mt-2" name="email" id="email" aria-describedby="emailHelp" placeholder="Masukan email">
                          </div>
                          <div class="form-group mt-2 mb-3">
                            <label for="password">Password</label>
                            <input type="password" required class="form-control mt-2" name="password" id="password" placeholder="Masukan password">
                          </div>
                          <div class="form-group mt-3 mb-3">
                            <div class="g-recaptcha" data-sitekey="6LfrEZclAAAAAJgEErPAmc3_Xz_6R0i2mKaJ-Det"></div>
                          </div>
                      </li>
                      <li class="list-group-item text-end">
                        <button type="submit" class="btn btn-primary ">Login</button>
                      </form>
                      </li>
                    </ul>
                  </div>
            </div>
        </div>
        <div class="col-md-4"></div>
        </div>
    </div>

</body>
</html>
<script src="/assets/bootstrap/js/bootstrap.js"></script>
<script src="/assets/aos/dist/aos.js"></script>
<script>
  AOS.init();
</script>
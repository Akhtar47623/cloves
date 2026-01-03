<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Reset Password</title>
    <style type="text/css">
        .card-body {
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
    background: white;
    padding:50px 50px;
}
.row.reset {
    display: flex;
    justify-content: center;
    height: 100vh;
    align-items: center;


}
.title-bar {
    display: flex;
    justify-content: center;
    color: #1d8dab;
}
}
.title-bar h4{
    /*padding: 4px 4px;*/
}
body{
    background: url('{{asset('assets/imgs/webb.png')}}');
    opacity:0.7;
    /*background-color: blue;*/
}
 img.dark-logo {
        width: 50%;
        height: 50%;
        position: relative;
        left: 25%;
    }
    </style>
  </head>
  <body>
    <section class="email-sec">
    <div class="container">
        <div class="row reset">
            <div class="col-md-7">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                       <div class="navbar-header mb-5">
                            <a class="navbar-brand" href="{{route('webIndexPage')}}"> 
                                <img src="{{asset(getImage())}}" alt="homepage" class="dark-logo"> 
                            </a> 
                        </div>
                    <div class="title-bar">
                        <h4 style="color: #7fb200;">Reset Your Password</h4>
                    </div>
                    <div class="form-div">
                        <form action="{{route('password.email')}}" method="POST">
                            @csrf
                            <!-- <input type="hidden" name="token" value="{{csrf_token()}}"> -->
                            <div class="form-group">
                                <label><h6>E-Mail Address</h6></label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Your Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button type="submit" class="btn btn  mt-3 text-white" style="background-color: #7fb200;">Send Link</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>            
        </div>
    </div>
    </section>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>
    
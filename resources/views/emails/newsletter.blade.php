

<html>



<head>



</head>



<body>



    @if($type=='admin')



    <h3>Hello,</h3>

    <p>New Subscriber Email is Registered</p>

    <p>Email: {{$email}}</p>



    @else

    <p>Your Email Has Been Registered</p>

    <!-- <p>Your Login Email is {{$email}}</p> -->

    <p>Thank you for newsletter subscription</p>

    <p>You will receive our newsletter on this email: {{$email}}</p>

    @endif



</body>



</html>
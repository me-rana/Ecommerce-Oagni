@extends('frontend.layout.main')
@section('main-section')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Croissant+One&display=swap');
        .custom-font{
            font-family: 'Croissant One', cursive;
        }
        .hh1{
            font-size: 50px;
        }
    </style>

    <div class="container py-5">
        <div class="custom-font">
            <h3 class="text-center hh1">Access Denied</h3>
            <p class="text-center">You have no rights to tried to enter this site without any authorization</p>
            <img src="../assets/img/access-denied.jpg" class="rounded mx-auto d-block" height="300px" alt="" srcset="">
            <center> <a name="" id="" class="btn btn-primary" href="{{route('sendMeBack')}}" role="button">Button</a> </center>
        </div>
    </div>

@endsection

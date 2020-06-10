@extends('layouts.app')

@section('content')
<style type="text/css">
    .btn-register{
        /*display: block !important;*/
        
        width: 300px;
        display: inline-block;
        border: none;
        font-size: 14px;
        font-weight: 600;
        min-width: 100px;
        padding: 18px 47px 14px;
        border-radius: 50px;
        text-transform: uppercase;
        color: #fff;
        line-height: normal;
        cursor: pointer;
        text-align: center;
        margin: 30px auto ;
    }
    .ppp{
        display: inline;
    }
    .company{
        background-color: #0b96a0;
        color: white;

    }
</style>
<section class="testimonial py-5" id="testimonial">
    <div class="container">
        <div class="row " style="margin: 0 auto;width: 800px;">
            <div class="col-md-6 py-5 bg-dark text-white text-center ">
                <div class=" ">
                    <div class="card-body">
                        <img src="http://www.ansonika.com/mavia/img/registration_bg.svg" style="width:30%">
                        <h2 class="py-3"> Registration</h2>
                        <p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 py-5 border">
                <div>
                    
                     <a class="site-btn btn-register" href="{{ route('registeration.form','designer') }}">Sign Up As A Designer</a>
                 </div>
            <div>
               
                <a class="btn company btn-register " href="{{ route('registeration.form','company') }}">Sign Up As A Company</a>
            </div>
            <div>
             
             <a class="btn-register btn-dark" href="{{ route('registeration.form','user') }}">Sign Up As A User</a>
            </div>
        </div>
    </div>
</section>
@endsection

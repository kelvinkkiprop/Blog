@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">About</div>

                    <div class="card-body">

                        <p class="card-text">{!! $about->description !!}</p>

                        {{-- <p>Hello Kenya!</p>

                        <p>My name is Maxwel Sumba and I am a freelance writer, techpreneur and internet marketer.
                        I am also the founder of {{config('app.name', 'Blog')}} which is a friendly website focused
                        on helping Kenyans to make money online.</p>

                        <p>Currently, freelancing is fast becoming a lucrative trend. With increased ICT knowledge, and
                        the world becoming a global village due to the internet, many people are making money online
                        working from home. Many (me included) have even quit their full-time jobs and gone on to pursue
                        their dreams online.</p>                         --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

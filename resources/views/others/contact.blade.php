@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Contact</div>

                    <div class="card-body">


                        <p class="card-text">{!! $contact->description !!}</p>

                        {{-- <p>Do you have any questions? Do you want to work with me on something?</p>
                        <p>Have you noticed something on the site that needs fixing? Need help?</p>

                        <p>Whatever the case, I’d love to read from you!</p>

                        <p>Simply fill in the contact form below and I’ll get back to you soonest.</p> --}}


                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf

                            <!-- Name -->
                            <div class="form-group">
                                <label for="name" class="col-form-label required">Name:</label>
                                <input id="name" type="text" class="form-control" name="name"
                                value="{{ old('name') }}" autocomplete="name" autofocus required>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email" class="col-form-label required">Email:</label>
                                <input id="email" type="text" class="form-control" name="email"
                                value="{{ old('email') }}" autocomplete="email" autofocus required>
                            </div>

                            <!-- Subject -->
                            <div class="form-group">
                                <label for="subject" class="col-form-label required">Subject:</label>
                                <input id="subject" type="text" class="form-control" name="subject"
                                value="{{ old('subject') }}" autocomplete="subject" autofocus required>
                            </div>

                            <!-- Message -->
                            <div class="form-group">
                                <label for="body" class="col-form-label required">Message:</label>
                                <textarea id="body" type="text" class="form-control" name="body"
                                value="{{ old('body') }}" autocomplete="body" autofocus required
                                rows="3"></textarea>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary">SEND</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

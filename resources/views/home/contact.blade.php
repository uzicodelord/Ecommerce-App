<head>
<title>Uzi-Shop - Contact</title>
@include('home.css')

@include('sweetalert::alert')
</head>
<body>
<div class="hero_area">
    @include('home.header')

    <div class="container" >
    <br>
    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
        <a class="navbar-brand" href="{{ url('/') }}">
            <img width="250" src="{{ asset('home/images/logo2.png') }}" alt="#" style="margin-top: -10px;" />
        </a>
    <form method="POST" action="{{ route('contact.send') }}">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
            <div class="alert alert-danger">{{ $messages }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
            <div class="alert alert-danger">{{ $messages }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" id="message" class="form-control" rows="5" required>{{ old('message') }}</textarea>
            @error('message')
            <div class="alert alert-danger">{{ $messages }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-secondary" style="color: #0a0a0a;text-align: center">Send Message</button>
    </form>
        <br><br>
</div>
</div>
</body>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <base href="/public">

    @include('admin.css')
    <style>
        label {
            display: inline-block;
            width: 100px;
            font-size: 15px;
            font-weight: bold;
        }
        .hhh {
            color: black;
        }
    </style>
</head>
<body>
@include('sweetalert::alert')

<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    @include('admin.header')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper bg-dark">
            @if (session()->has('message'))
                <div class="alert alert-primary">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
            @endif
            <h1 style="font-size: 25px;text-align: center">
                Send E-mail to {{ $order->email }}
            </h1>
            <form action="{{ url('sendmailR', $order->id) }}" method="POST">
                @csrf
                <div style="padding-left: 42%;padding-top: 30px;">
                    <label for="">Greeting</label>
                    <input type="text" name="greeting" class="hhh">
                </div>
                <div style="padding-left: 42%;padding-top: 30px;">
                    <label for="">Subject</label>
                    <input type="text" name="subject" class="hhh">
                </div>
                <div style="padding-left: 42%;padding-top: 30px;">
                    <label for="body">Body</label>
                    <input type="text" name="body" class="hhh">
                </div>
                <div style="padding-left: 42%;padding-top: 30px;">
                    <label for="">Button Name</label>
                    <input type="text" name="button" class="hhh">
                </div>
                <div style="padding-left: 42%;padding-top: 30px;">
                    <label for="body">Url</label>
                    <input type="text" name="url" class="hhh">
                </div>
                <div style="padding-left: 42%;padding-top: 30px;">
                    <label for="">Best Regards</label>
                    <input type="text" name="lastline" class="hhh">
                </div>
                <div style="padding-left: 42%;padding-top: 30px;">
                    <input type="submit" value="Send Email" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>
</html>

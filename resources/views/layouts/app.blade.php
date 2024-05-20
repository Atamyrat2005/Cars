<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
</head>
<body class="bg-light">
@include('app.nav')
@include('app.alert')
@yield('content')

@auth
    <script>
        $('.btn-active').click(function () {
            let self = $(this);
            self.attr("disabled", true);
            $.ajax({
                url: "{{ route('cars.active') }}",
                dataType: "json",
                type: "POST",
                data: {"_token": "{{ csrf_token() }}", "id": self.val()},
                success: function (result, status, xhr) {
                    self.attr("disabled", false);
                    if (result["active"] > 0) {
                        self.prev().addClass('d-none');
                        self.removeClass('btn-success').addClass('btn-danger').html('<i class="bi-x-lg"></i>');
                    } else {
                        self.prev().removeClass('d-none');
                        self.removeClass('btn-danger').addClass('btn-success').html('<i class="bi-check-lg"></i>');
                    }
                },
                error: function (result, status, xhr) {
                    self.html("Error");
                },
            });
        });
    </script>
@endauth
</body>
</html>
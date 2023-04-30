<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .form {
                padding: 0.5rem;
                border: 1px solid #555;
                border-radius: 4px;
            }

            .input {
                border: 1px solid #999;
                padding: 0.5rem;
                font-family: sans-serif;
                border-radius: 4px;
                padding-bottom: 0.5rem;
                margin-right: 0.5rem;
            }

            .pay_button {
                padding: 0.5rem;
                border-radius: 4px;
                border: 1px solid transparent;
                background-color: #333;
                color: #fff;
                cursor: pointer;
                transition: all 0.2s;
            }

            .pay_button:hover {
                background-color: #fff;
                border-color: #333;
                color: #333;
            }

            .error {
                display: block;
                font-size: 12px;
                color: #c70000;
            }
        </style>
    </head>
    <body class="antialiased">
        <form class="form" action="{{ route('payment'); }}" method="post">
            @csrf
            @error('price') 
            <span class="error"> 
                @foreach ($errors->all() as $error)
                     {{ $error }}
                 @endforeach
            </span>
            @enderror
            <input class="input" type="unmber" name="price" placeholder="Pay now." max="5" />
            <button class="pay_button" type="submit">Pay now.</button>
            {{-- <ul><li></li></ul> --}}
        </form>
    </body>
</html>

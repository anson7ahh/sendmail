<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="{{ asset('client/css/edit.css') }}">


<body>
    <div class ='create_user'>
        <h2>cap nhat thong tin</h2>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            nhập lại thông tin
        </div>
    @endif





    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    {{-- @if (!empty($error))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                @endforeach
            </ul>
        </div>
    @endif --}}
    <div class='register'>
        <form action="{{ route('update', [$user->id]) }}" method="post">
            @csrf
            <label for="Name">
                Name:
                <input type="text" name="name" value="{{ old('username') }}">
                {{-- value="{{ old('title') }}> --}}
                {{-- @error('name')
                <span style="color: red">{{ $error }}</span>
            @enderror --}}
                @error('name')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </label>
            <br><br>
            <label for="Email">
                Email:
                <input type="text" name="email" value="{{ old('username') }}" />
                @error('email')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </label><br><br>


            <label for="Password">
                Password:
                <input type="text" name="password"value="{{ old('password') }}">
                @error('password')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </label><br><br>


            <button type="submit">Cap nhat</button>

        </form>

    </div>



</body>

</html>

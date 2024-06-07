<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Noto+Kufi+Arabic:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            font-family: "Noto Kufi Arabic", sans-serif;
        }
    </style>
</head>
<body dir="rtl">
    <div class="container">
        <h1 class="text-center" style="margin-top: 24px;">لاضافة او تعديل بيانات لاعب</h1>
        <p class="text-center">قم بمسح ال QR كود للاعب او ادخل كود الاعب</p>
        <form action="/user-by-code" class="card shadow p-3" style="margin: auto; max-width: 400px">
            <div class="form-group mb-2">
                <label for="code" class="mb-2 mr-2">كود اللاعب</label>
                <input type="text" class="form-control" id="code" name="code" aria-describedby="emailHelp" placeholder="كود الاعب" >
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('error') }}</small>
            </div>
            <button class="btn btn-primary">بحث</button>
        </form>
    </div>
    <br>
    @if (Auth::user()->role === "Master")
        <hr>
        @php
            $users = App\Models\User::paginate(20);
        @endphp
        <div class="container mt-5">
            <h2 class="mb-4">الاعبين المسجلين حتى الان</h2>
            <a class="btn btn-success" href="/export">تحميل</a>
            <br>
            <br>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>اسم الاعب</th>
                        <th>رقم الهاتف</th>
                        <th>تاريخ التسجيل</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->code }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td><a href="/user/edit/{{$user->id}}/{{$user->code}}" class="btn btn-success">تعديل بيانات اللاعب</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @endif
</body>
</html>

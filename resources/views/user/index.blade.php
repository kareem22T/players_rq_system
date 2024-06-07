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
        <br>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        <br>
    @endif

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
                            <td style="text-transform: uppercase">{{ $user->code }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{
                                $user->phase == 1 ? "مرحلة اولي" :
                                ($user->phase == 2 ? "مرحلة ثانية" :
                                ($user->phase == 3 ? "مرحلة ثالثة" : "مرفوض")),

                             }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a href="/user/edit/{{$user->id}}/{{$user->code}}" class="btn btn-success">تعديل بيانات اللاعب</a>
                                <button class="btn btn-danger" href-data="{{route("user.delete", ['id' => $user->id])}}" onclick="confirmDeletion({{$user->id}})" >حذف بيانات اللاعب</button>
                                <button class="btn btn-info" onclick="showPopUp({{$user->id}}, '{{$user->code}}', {{$user->phase}})">تعديل المرحلة</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="hide-content"style="position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: #0000005e;z-index: 96999;display: none"></div>
            <div id="pop-up" style="position: fixed;z-index: 9999999;top: 50%;left: 50%;width: 400px;background: #d8d8d8;padding: 1rem;transform: translate(-50%, -50%);display:none">
                <div class="form-group mb-4">
                    <h1 id="player_id"></h1>
                    <label for="phase" class="mb-2 mr-2">المرحلة</label>
                    <select class="form-control" name="phase">
                      <option value="1">مرحلة اولي</option>
                      <option value="2">مرحلة ثانية</option>
                      <option value="3">مرحلة ثالثة</option>
                      <option value="4">مرفوض</option>
                    </select>
                    <input type="hidden" id="curr_user_id">
                  </div>
                <div class="d-flex" style="justify-content: center; gap: 10px">
                    <button class="btn btn-primary" onclick="update()">Save</button>
                    <button class="btn btn-secondary"  onclick="hidePop()">Cancel</button>
                </div>
            </div>
            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function confirmDeletion(id) {
            const userConfirmed = confirm('هل أنت متأكد من أنك تريد حذف بيانات اللاعب؟');
            if (userConfirmed) {
                const url = '/user/delete/' + id;
                console.log('Redirecting to:', url);
                window.location.href = '/user/delete?id=' + id;
            }
        }
        function showPopUp(id, code, phase) {
            $("#pop-up").find("#player_id").val(code)
            $("#pop-up").find("#curr_user_id").val(id)
            $("#pop-up").find("select").val(phase)
            $("#pop-up").fadeIn(id)
            $(".hide-content").fadeIn(id)
        }
        function hidePop() {
            $("#pop-up").fadeOut()
            $(".hide-content").fadeOut()
        }
        function update() {
            let id = $("#pop-up").find("#curr_user_id").val()
            let phase = $("#pop-up").find("select").val()
            window.location.href = '/user/update-phase?id=' + id + "&phase=" + phase;
        }
    </script>
</body>
</html>

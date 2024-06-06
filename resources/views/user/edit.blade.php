<!DOCTYPE html>
<html>
<head>
    <title>تعديل مستخدم</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Noto+Kufi+Arabic:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Noto Kufi Arabic", sans-serif;
        }
    </style>
</head>
<body dir="rtl">
    <div class="container">
        <h1 class="text-center" style="margin-top: 24px;">تعديل بيانات اللاعب</h1>
        <br>
        <div style="display: grid; grid-template-columns: 1fr 2fr;gap: 24px;margin-top: 24px; grid-template-rows: 460px">
            <div class="img">
                <img src="{{asset('assets/imgs/main.jpg')}}" style="width: 100%;height: 100%;object-fit: cover;border-radius: 16px;" alt="">
            </div>
            <form action="{{ url("/user/$uuid/$code") }}" method="POST">
                <input type="hidden" name="id" value="{{$uuid}}">
                <input type="hidden" name="code" value="{{$code}}">
                @csrf
                <div class="form-group mb-2">
                    <label for="name" class="mb-2 mr-2">اسم اللاعب</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="اسم الاعب " value="{{$user->name}}">
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
                </div>
                <div class="form-group mb-2">
                    <label for="phone" class="mb-2 mr-2">رقم الهاتف الاساسي</label>
                    <input type="text" class="form-control" id="phone" name="phone"  aria-describedby="emailHelp" placeholder="رقم الهاتف"  value="{{$user->phone}}">
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('phone') }}</small>
                    {{-- <small id="emailHelp" class="form-text text-danger">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group mb-2">
                    <label for="sec_phone" class="mb-2 mr-2">رقم الهاتف الاحتياطي</label>
                    <input type="text" class="form-control" id="sec_phone" name="sec_phone" aria-describedby="emailHelp" placeholder="رقم الهاتف الاحتياطي"  value="{{$user->sec_phone}}">
                    {{-- <small id="emailHelp" class="form-text text-danger">We'll never share your email with anyone else.</small> --}}
                </div>
                <div class="form-group mb-2">
                    <label for="position" class="mb-2 mr-2">مركز اللاعب</label>
                    <select class="form-control" name="position">
                      <option value="1" {{ isset($user->position) && $user->position == 1 ? 'selected' : '' }}>مهاجم</option>
                      <option value="2" {{ isset($user->position) && $user->position == 2 ? 'selected' : '' }}>خط وسط</option>
                      <option value="3" {{ isset($user->position) && $user->position == 3 ? 'selected' : '' }}>مدافع</option>
                      <option value="4" {{ isset($user->position) && $user->position == 4 ? 'selected' : '' }}>حارس</option>
                    </select>
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('position') }}</small>
                  </div>

                  <div class="form-group mb-4">
                    <label for="age_group" class="mb-2 mr-2">الفئة العمرية</label>
                    <select class="form-control" name="age_group">
                      @for ($year = 2005; $year <= 2016; $year++)
                        <option value="{{ $year }}" {{ isset($user->age_group) && $user->age_group == $year ? 'selected' : '' }}>{{ $year }}</option>
                      @endfor
                    </select>
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('age_group') }}</small>
                  </div>

                  <div class="form-group mb-4">
                    <label for="phase" class="mb-2 mr-2">المرحلة</label>
                    <select class="form-control" name="phase">
                      <option value="1" {{ isset($user->phase) && $user->phase == 1 ? 'selected' : '' }}>مرحلة اولي</option>
                      <option value="2" {{ isset($user->phase) && $user->phase == 2 ? 'selected' : '' }}>مرحلة ثانية</option>
                      <option value="3" {{ isset($user->phase) && $user->phase == 3 ? 'selected' : '' }}>مرحلة ثالثة</option>
                      <option value="4" {{ isset($user->phase) && $user->phase == 4 ? 'selected' : '' }}>مرفوض</option>
                    </select>
                  </div>

                <button type="submit" class="btn btn-success w-100">تحديث</a>
            </form>
        </div>
    </div>
</body>
</html>

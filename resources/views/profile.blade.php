@extends('layouts/app')
@section('content')

<div class="container emp-profile">
    <form class="form" method="post" action="{{ route('profileUpload') }}" enctype='multipart/form-data'>
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="{{ asset('storage/profile/').'/'.$user->profile }}" alt="" width="100" height="100"/>
                        <div class="form-group">
                            <!-- <label for="exampleFormControlFile1">Example file input</label> -->
                            {{-- <input type="file" name='file' class="form-control-file mt-3" id="exampleFormControlFile1"> --}}
                            <input type="file" name="file" id="">
                        </div>
                </div>
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit" name='but_upload' id="profilepicinput">Upload Picture</button>
                </div>
            </div>
        </div>
    </form>
    <form action="{{route('profile.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-2">
                                <label>First Name</label>
                            </div>
                            <div class="col-md-10">
                                <p><input class="form-control" type="text" name="first_name" id="first_name" placeholder="First Name" value="{{ $user->first_name }}"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>Last Name</label>
                            </div>
                            <div class="col-md-10">
                                <p><input class="form-control" type="text" name="last_name" id="last_name" value="{{ $user->last_name }}"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>Email</label>
                            </div>
                            <div class="col-md-10">
                                <p><input class="form-control" type="text" name="email" id="email" value="{{ $user->email }}" disabled></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>Expense Limit</label>
                            </div>
                            <div class="col-md-10">
                                <p><input class="form-control" type="number" name="expenseLimit" id="expenseLimit" value="{{ $user->expense_limit }}"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-block btn-md btn-success" style="border-radius:0%;" name="save" type="submit">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@section('js')
<script>
        @if (session()->has('success'))
        swal.fire("Done!", "{{ session()->get('success') }}", "success");
        @elseif(session()->has('error'))
        swal.fire("Error!", "{{ session()->get('error') }}", "error");
        @endif
    </script>

@endsection

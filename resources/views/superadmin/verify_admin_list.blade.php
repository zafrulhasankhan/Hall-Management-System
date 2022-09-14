@extends('superadmin.superadmin_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center;font-size:20px;font-family: cursive">{{ __('Admin List') }}</div>
                <div class="card-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin_list as $admin)
                            <tr>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->mobileno }}</td>
                                <td>
                                    <a href="{{ route('superadmin.verfiy_admin_click',$admin->id) }}" class="btn btn-success">verify</a>
                                    <!--  -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                    <p class="mb-2 text-sm mx-auto">
                        Already have an account?
                        <a href="{{ route('admin.login') }}" class="text-primary text-gradient font-weight-bold">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('DT_script')
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endsection
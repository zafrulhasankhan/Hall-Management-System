@extends('layouts.AppTemplate')


@section('nav-bread')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Notification</li>
  </ol>
  <h6 class="font-weight-bolder mb-0">Notification{{ Auth::user()->id }}</h6>
</nav>
@endsection
@section('section')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <div class="card mt-4">
        <div class="card-header p-3">
          <h5 class="mb-0">Alerts</h5>
        </div>
        <div class="card-body p-3 pb-0">
          @foreach($admins as $admin)
          @foreach($admin->unreadNotifications as $notification)
          @if(Auth::user()->id === $notification->notifiable_id)
          <div class="alert alert-secondary alert-dismissible text-white" role="alert">
            <span class="text-sm"><a href="#" id="{{ $notification->data['id'] }}" class="alert-link text-white notify_details">'{{ $notification->data['username'] }}' Requested to join '{{ $notification->data['institute_name'] }}' group.</a>&ensp;
              <button type="submit" class="btn-sm btn-primary">Approve</button>
              <button type="submit" class="btn-sm btn-warning">Decline</button>
              <h5 style="display: none;">hello</h5>
            </span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times; </span>
            </button>
          </div>

          <div class="card-body pt-4 p-3 notify_details_block" id="details_{{ $notification->data['id'] }}" style="display: none;">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">{{ $notification->data['username'] }}</h6>
                    <span class="mb-1 text-xs">Email: <span class="text-dark font-weight-bold ms-sm-2">{{ $notification->data['email'] }}</span></span>
                    <span class="mb-1 text-xs">Department Name: <span class="text-dark font-weight-bold ms-sm-2">{{ $notification->data['dept_name'] }}</span></span>
                    <span class="mb-1 text-xs">Student ID: <span class="text-dark ms-sm-2 font-weight-bold">{{ $notification->data['student_ID'] }}</span></span>
                    <span class="mb-1 text-xs">Session: <span class="text-dark ms-sm-2 font-weight-bold">{{ $notification->data['session'] }}</span></span>
                    <span class="mb-1 text-xs">Room No.: <span class="text-dark ms-sm-2 font-weight-bold">{{ $notification->data['roomno'] }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="{{ route('register_notification_approve',$notification->data['id']) }}"><i class="material-icons text-sm me-2">Approve</i>Approve</a>
                    <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('register_notification_decline',$notification->data['id']) }}"><i class="material-icons text-sm me-2">Delete</i>Delete</a>
                  </div>
                </li>
              </ul>
          </div>


          @endif
          @endforeach
          @endforeach
          <div class="alert alert-secondary alert-dismissible text-white" role="alert">
            <span class="text-sm">A simple secondary alert with <a href="javascript:;" class="alert-link text-white">an example link</a>. Give it a click if you like.</span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="alert alert-success alert-dismissible text-white" role="alert">
            <span class="text-sm">A simple success alert with <a href="javascript:;" class="alert-link text-white">an example link</a>. Give it a click if you like.</span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="alert alert-danger alert-dismissible text-white" role="alert">
            <span class="text-sm">A simple danger alert with <a href="javascript:;" class="alert-link text-white">an example link</a>. Give it a click if you like.</span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="alert alert-warning alert-dismissible text-white" role="alert">
            <span class="text-sm">A simple warning alert with <a href="javascript:;" class="alert-link text-white">an example link</a>. Give it a click if you like.</span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="alert alert-info alert-dismissible text-white" role="alert">
            <span class="text-sm">A simple info alert with <a href="javascript:;" class="alert-link text-white">an example link</a>. Give it a click if you like.</span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="alert alert-light alert-dismissible text-white" role="alert">
            <span class="text-sm">A simple light alert with <a href="javascript:;" class="alert-link text-white">an example link</a>. Give it a click if you like.</span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="alert alert-dark alert-dismissible text-white" role="alert">
            <span class="text-sm">A simple dark alert with <a href="javascript:;" class="alert-link text-white">an example link</a>. Give it a click if you like.</span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
      <div class="card mt-4">
        <div class="card-header p-3">
          <h5 class="mb-0">Notifications</h5>
          <p class="text-sm mb-0">
            Notifications on this page use Toasts from Bootstrap. Read more details <a href="https://getbootstrap.com/docs/5.0/components/toasts/" target="
          ">here</a>.
          </p>
        </div>
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
              <button class="btn bg-gradient-success w-100 mb-0 toast-btn" type="button" data-target="successToast">Success</button>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 mt-sm-0 mt-2">
              <button class="btn bg-gradient-info w-100 mb-0 toast-btn" type="button" data-target="infoToast">Info</button>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 mt-lg-0 mt-2">
              <button class="btn bg-gradient-warning w-100 mb-0 toast-btn" type="button" data-target="warningToast">Warning</button>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 mt-lg-0 mt-2">
              <button class="btn bg-gradient-danger w-100 mb-0 toast-btn" type="button" data-target="dangerToast">Danger</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="position-fixed bottom-1 end-1 z-index-2">
    <div class="toast fade hide p-2 bg-white" role="alert" aria-live="assertive" id="successToast" aria-atomic="true">
      <div class="toast-header border-0">
        <i class="material-icons text-success me-2">
          check
        </i>
        <span class="me-auto font-weight-bold">Material Dashboard </span>
        <small class="text-body">11 mins ago</small>
        <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
      </div>
      <hr class="horizontal dark m-0">
      <div class="toast-body">
        Hello, world! This is a notification message.
      </div>
    </div>
    <div class="toast fade hide p-2 mt-2 bg-gradient-info" role="alert" aria-live="assertive" id="infoToast" aria-atomic="true">
      <div class="toast-header bg-transparent border-0">
        <i class="material-icons text-white me-2">
          notifications
        </i>
        <span class="me-auto text-white font-weight-bold">Material Dashboard </span>
        <small class="text-white">11 mins ago</small>
        <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
      </div>
      <hr class="horizontal light m-0">
      <div class="toast-body text-white">
        Hello, world! This is a notification message.
      </div>
    </div>
    <div class="toast fade hide p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="warningToast" aria-atomic="true">
      <div class="toast-header border-0">
        <i class="material-icons text-warning me-2">
          travel_explore
        </i>
        <span class="me-auto font-weight-bold">Material Dashboard </span>
        <small class="text-body">11 mins ago</small>
        <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
      </div>
      <hr class="horizontal dark m-0">
      <div class="toast-body">
        Hello, world! This is a notification message.
      </div>
    </div>
    <div class="toast fade hide p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="dangerToast" aria-atomic="true">
      <div class="toast-header border-0">
        <i class="material-icons text-danger me-2">
          campaign
        </i>
        <span class="me-auto text-gradient text-danger font-weight-bold">Material Dashboard </span>
        <small class="text-body">11 mins ago</small>
        <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
      </div>
      <hr class="horizontal dark m-0">
      <div class="toast-body">
        Hello, world! This is a notification message.
      </div>
    </div>
  </div>
  <footer class="footer py-4  ">
    <div class="container-fluid">
      <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6 mb-lg-0 mb-4">
          <div class="copyright text-center text-sm text-muted text-lg-start">
            Â© <script>
              document.write(new Date().getFullYear())
            </script>,
            made with <i class="fa fa-heart"></i> by
            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
            for a better web.
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="nav nav-footer justify-content-center justify-content-lg-end">
            <li class="nav-item">
              <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function(e) {
    $('.notify_details').click(function() {
      var some = $(this).attr("id");
      console.log(some);
      $("#details_"+some).toggle();
    });
  })
</script>
@extends('backend.app')

@section('main-content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Manage Member</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

          <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- jquery validation -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Add Member</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                @if(session('member_success'))
                <script type="text/javascript">
                   Swal.fire({
                  icon: 'success',
                  title: 'success...',
                  text: 'Member Added Successfully !!',
                })
                </script>
                @endif

                 @if(session('member_error'))
                <script type="text/javascript">
                   Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Something Went Wrong !!',
                })
                </script>
                @endif

                <form id="quickForm" action="{{route('save-member')}}" method="post" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" name="member_name" class="form-control" id="member_name" placeholder="Enter Full Name" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Profile Image</label>
                      <input type="file" name="profile_image" class="form-control" id="image" required>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Add Member</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
              </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

      <script>
        $(function () {
          $.validator.setDefaults({
            submitHandler: function () {
              alert( "Form successful submitted!" );
            }
          });
          $('#quickForm').validate({
            rules: {
              email: {
                required: true,
                email: true,
              },
              password: {
                required: true,
                minlength: 5
              },
              terms: {
                required: true
              },
            },
            messages: {
              email: {
                required: "Please enter a email address",
                email: "Please enter a valid email address"
              },
              password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
              },
              terms: "Please accept our terms"
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
              $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
              $(element).removeClass('is-invalid');
            }
          });
        });
        </script>


@endsection

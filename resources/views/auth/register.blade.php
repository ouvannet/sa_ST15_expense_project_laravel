<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container-fluid vh-100">
        <div class="row h-100 g-0">
            <!-- Left Image Section -->
            <div class="col-md-6 d-none d-md-block">
                <div class="h-100">
                    <img src="/assets/img/login_image.jpg" 
                         alt="Login Image" 
                         class="img-fluid w-100 h-100" 
                         style="object-fit: cover;">
                </div>
            </div>

            <!-- Right Form Section -->
            <div class="col-md-6 d-flex align-items-center justify-content-center ">
                <div class="card p-4 border-0" style="max-width: 500px; width: 100%;">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Welcome</h3>
                        <p class="text-muted mb-0">Create an account</p>
                    </div>

                    <!-- Display Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form action="{{ route('register') }}" method="POST" id="registerForm">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" value="seyhaaaa@gmail.com" name="email" id="email" 
                                   class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Username</label>
                            <input type="text" value="1ddd" name="name" id="name" 
                                   class="form-control" placeholder="Enter your password" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-bold">Phone Number</label>
                            <input type="number" value="123" name="phone" id="phone" 
                                   class="form-control" placeholder="Enter your password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input type="password" value="123" name="password" id="password" 
                                   class="form-control" placeholder="Enter your password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" id="btn_register" class="btn btn-primary btn-lg btn-register">Register</button>
                        </div>
                        <div class="text-center mt-3">
                            <small class="text-muted">ALready have an account? 
                                <a href="{{ route('login') }}" class="text-decoration-none">Login Now</a>
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>



@push('js')
    <script>
        function reloadPage(){
            setTimeout(function(){
                location.reload();
            }, 1000);
        }
       
        $(document).on('click',"#btn_register",function(){
            const formData = $("#registerForm").serializeArray();
            console.table(formData);
            $.ajax({
                url: "{{ route('register.submit_add') }}",
                type: 'POST',
                data: formData,
                success: function (response) {
                    console.log(response);
                    if(response.status==1){
                        $("#globalModalView").modal('toggle');
                        Swal.fire({
                            title: response.message,
                            icon: "success",
                            draggable: true
                        });
                        reloadPage();
                    }
                },
                error: function (xhr) {
                    console.log(xhr);
                    
                }
            });
        })

       
     

      
    </script>
@endpush

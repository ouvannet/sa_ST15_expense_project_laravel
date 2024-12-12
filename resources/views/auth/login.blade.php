<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container-fluid vh-100">
        <div class="row h-100 g-0">
            <!-- Left Image Section -->
            <div class="col-md-6 d-none d-md-block">
                <div class="h-100">
                    <img src="/assets/img/loginimage.jpg" 
                         alt="Login Image" 
                         class="img-fluid w-100 h-100" 
                         style="object-fit: cover;">
                </div>
            </div>

            <!-- Right Form Section -->
            <div class="col-md-6 d-flex align-items-center justify-content-center ">
                <div class="card p-4 border-0" style="max-width: 500px; width: 100%;">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Welcome Back</h3>
                        <p class="text-muted mb-0">Please log in to your account</p>
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
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" value="seyha@gmail.com" name="email" id="email" 
                                   class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input type="password" value="123" name="password" id="password" 
                                   class="form-control" placeholder="Enter your password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                        </div>
                        <div class="text-center mt-3">
                            <small class="text-muted">Don't have an account? 
                                <a href="#" class="text-decoration-none">Sign up</a>
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PNB Scholarship</title>
  <style>
   * {
  box-sizing: border-box;
  margin: 0; /*new*/
  padding: 0; /*new*/
  }
  body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    /* margin: 0;
    padding: 0; */
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    /* position: relative; */
    padding-top: 100px; /* Adds space between logo and container */
  }
  .container {
    display: flex;
    flex-direction: row; /* new */
    /* max-width: 1400px;  */
    max-width: 1200px; /* new */
    background-color: white;
    border-radius: 16px;
    padding: 40px; /* Adjusted padding */
    box-shadow: 0px 14px 34px rgba(0, 0, 0, 0.08);
    /* position: relative; */
    gap: 50px;
    align-items: center; /* new */
  }
  .content {
     /* Reduced size of the sign-in form */
     /* flex: 0.7; */
     flex:1;
    padding-right: 20px; /* Adjusted padding */
  }
  .heading {
    font-size: 32px;
    font-weight: bold;
    color: #111827;
    margin-bottom: 24px;
    text-align: center;
  }
  .form-group {
    margin-bottom: 16px;
  }
  .form-group label {
    display: block;
    font-size: 16px;
    margin-bottom: 8px;
    color: #6b7280;
  }
  .form-group input {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
  }
  .form-group input:focus {
    outline: none;
    border-color: #2563eb;
  }
  .button-primary {
    background-color: #2563eb;
    color: white;
    padding: 16px 32px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 18px;
    text-align: center;
    width: 100%;
  }
  .button-primary:hover {
    background-color: #1e40af;
  }
  .forgot-password {
    text-align: right;
    margin-top: 8px;
  }
  .forgot-password a {
    color: #2563eb;
    text-decoration: none;
    font-size: 14px;
  }
  .forgot-password a:hover {
    text-decoration: underline;
  }
  .remember-forgot-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
  }
  .image {
    /* Increased size of the image container */
    flex: 1.3; 
   
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .image img {
    width: 100%;
    /* Set a maximum width for the image */
    max-width: 700px; 
    /* max-width: 500px; */
    height: auto; /* Maintain aspect ratio */
    border-radius: 12px;
  }
  /* Logo positioning */
  .logo {
    position: absolute;
    top: 20px; /* Adjust this value to move logo higher/lower */
    left: 50%;
    transform: translateX(-50%);
    width: 120px; /* Adjust the size of the logo */
    height: auto;
    /* Add gap between the logo and the container */
    /* margin-bottom: 20px;  */
  }
  /* Custom error message styling */
  .error-message {
    color: red;
    font-size: 14px;
    margin-top: 8px;
    list-style: none; /* Remove bullet points */
    padding: 0; /* Remove default padding */
  }

  /* NEW CODE */
  /* Responsive Design */
  @media (max-width: 768px) {
  .container {
  flex-direction: column;
  text-align: center;
  padding: 20px;
  }
  
  .image {
  order: -1; /* Moves image above the form */
  margin-bottom: 20px;
  }
  
  .image img {
  max-width: 90%;
  }
  
  .content {
  width: 100%;
  padding: 0;
  }
  
  .form-group input {
  font-size: 14px;
  padding: 10px;
  }
  
  .button-primary {
  font-size: 16px;
  padding: 12px;
  }
  
  .remember-forgot-wrapper {
  flex-direction: column;
  align-items: center;
  }
  
  .forgot-password {
  text-align: center;
  }
  }

  </style>
</head>
<body>

<!-- Logo at the top -->
{{-- <img src="{{url('/images/PNB_Logo_Blue_RGB.png')}}" alt="Logo" class="logo"> --}}

<div class="container">
  <div class="content">
    <h1 class="heading">Sign in</h1>

    <!-- Add a placeholder for the session status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form action="/login" method="POST">

      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="text-center" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
        <p class="mt-2 text-sm text-gray-600">
          Don't have an account yet?
            <a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500" href="/register" style="text-decoration: none;">
            Sign up here
          </a>
        </p>
      </div>
      <br>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required autofocus>
          @if($errors->has('email'))
            <ul class="error-message">
              <li>{{ $errors->first('email') }}</li>
            </ul>
          @endif
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
          @if($errors->has('password'))
            <ul class="error-message">
              <li>{{ $errors->first('password') }}</li>
            </ul>
          @endif
      </div>

      <!-- Remember Me -->
      <div class="block mt-4 remember-forgot-wrapper">
        <label for="remember_me" class="inline-flex items-center">
          <input id="remember_me" type="checkbox" name="remember">
          <span class="ml-2 text-sm text-gray-600">Remember me</span>
        </label>
      </div>

      <div class="text-center" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
        <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}" style="text-decoration: none;">
          Forgot password?
        </a>

        <br>

        <button class="button-primary" type="submit">
          Log in
        </button>
      </div>
    </form>
  </div>

  <div class="image">
    <img src="{{ url('/images/PNB_Scholarship_YTI04.png') }}" alt="Placeholder Image">
  </div>
</div>

</body>
</html>

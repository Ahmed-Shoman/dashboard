<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/style.css') }}
" />
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />
  </head>
  <body>
    <section class="home">
      <div class="form_container">
          <form action="#">
            <h2>Login</h2>
            <div class="input_box">
              <input type="email" placeholder="Enter your email" required />
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input
                type="password"
                placeholder="Enter your password"
                required
              />
              <i class="uil uil-lock password"></i>
            </div>
            <button class="button" type="submit">Login Now</button>
          </form>
      </div>
    </section>
  </body>
</html>

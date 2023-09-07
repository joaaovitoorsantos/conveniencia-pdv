<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.104.2">
  <title>Login | Conveniencia 239</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">


  <!-- Custom styles for this template -->
  <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">

  <main class="form-signin w-100 m-auto">
    <form action="autenticar.php" method="POST">
      <img class="mb-4" src="https://i.imgur.com/sErinrl.png" alt="" height="300" style="margin-bottom: -60px !important;">

      <div class="container">

        <div class="form-floating">
          <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
          <label for="floatingInput">Email</label>
          <div class="invalid-feedback">
            Insira um endereço de email valido.
          </div>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="senha" name="senha" placeholder="Password">
          <label for="floatingPassword">Senha</label>
        </div>
        <button class="w-100 btn btn-lg btn-warning" type="submit">Entrar</button>
        <p class="mt-5 mb-3 text-muted">&copy; Conveniência 239</p>
      </div>
    </form>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://kit.fontawesome.com/4bc7332f41.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="https://i.imgur.com/Y8QkMxb.png" alt="" height="40">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <script>
        $(document).ready(function () {
          // Pega a URL atual
          var url = window.location.pathname;

          // Adiciona a classe "active" ao link correspondente
          $('.nav-item a[href="' + url + '"]').addClass('active');
        });

      </script>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vendas.php">Vendas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="estoque.php">Estoque</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="estoque-vazio.php">Pouco estoque</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data-validade.php">Produtos vencendo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="faturamento.php">Faturamento</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="convenio.php">Convenio</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Sair</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


</body>
<?php
$redirectUrl = 'https://midoricapital.com.br';
$redirectDelay = 180;
header("refresh:{$redirectDelay};url={$redirectUrl}");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <noscript>
    <meta http-equiv="refresh" content="30;url=https://midoricapital.com.br">
  </noscript>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>PIX Payment - The Brokers Capital | Powered by Midori Capital</title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />

  <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
  <!--Replace with your tailwind.css once created-->
  <link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet" />

  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap");

    html {
      font-family: "Poppins", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    }
    input[type=number]::-webkit-inner-spin-button {
      -webkit-appearance: none;
    }
    input[type=number] {
      -moz-appearance: textfield;
      appearance: textfield;
    }
  </style>
</head>

<body class="leading-normal tracking-normal text-indigo-400  bg-cover bg-fixed" style="background-image: url('https://i.ibb.co/Y8vJQpG/header.png');">
<div class="h-full">
  <!--Nav-->
  <nav class="bg-gray-900 drop-shadow-lg opacity-70 w-full">
    <div class="w-full mx-auto container">
      <div class="w-full flex items-center justify-between">
        <a class="flex items-center text-indigo-400 no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="#">
          <span class="bg-clip-text text-transparent bg-gradient-to-tr from-green-600 via-sky-600 to-teal-200">Midori Capital</span>
        </a>

        <div class="flex w-1/2 justify-end content-center p-2">
          <a href="https://thebrokerscapital.com" target="_blank"><img class="md:h-12" src="https://thebrokerscapital.com/wp-content/uploads/2019/09/cropped-logobrk-300x99.png"></a>
        </div>
      </div>
    </div>
  </nav>

  <!--Main-->
  <div class="container pt-8 mx-auto flex flex-wrap flex-col md:flex-row items-start justify-center gap-4">
    <!--Left Col-->
    <div class="flex flex-col w-full xl:w-3/5 justify-center lg:items-start overflow-y-hidden">
      <h1 class="mt-4 text-3xl md:text-3xl text-white opacity-70 font-bold leading-tight text-center md:text-left">
        Gerar pagamento em PIX
      </h1>
      <p class="leading-normal text-base md:text-xl mb-3 text-center md:text-left">
        Preencha com seus dados
      </p>

      <!-- FORM STARTS -->
      <form method="POST" action="process.php" id="personalInfo" class="bg-gray-900 drop-shadow-lg opacity-70 w-full shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">

        <!-- 1 ROW -->
        <div class="mb-4">
          <label class="block text-blue-300 py-2 font-bold" for="name">
            Nome
          </label>
          <input
            class="shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
            id="name"
            name="name"
            type="text"
            placeholder="Seu nome completo"
            required
            />
        </div>

        <!-- 2 ROW -->
        <div class="mb-4 md:flex md:gap-6">
          <div class="md:w-1/2">
            <label class="block text-blue-300 py-2 font-bold" for="metatrade">
              ID MetaTrade
            </label>
            <input
              class="shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
              id="metatrade"
              name="metatrade"
              type="number"
              placeholder="Conta de depósito"
              required
              />
          </div>

          <div class="md:w-1/2">
            <label class="block text-blue-300 py-2 font-bold" for="email">
              Email
            </label>
            <input
              class="shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
              id="email"
              name="email"
              type="email"
              placeholder="E-mail cadastrado na corretora"
              required
              />
          </div>
        </div>

        <!-- 3 ROW -->
        <div class="mb-4 md:flex md:gap-6">
          <div class="md:w-1/2">
            <label class="block text-blue-300 py-2 font-bold" for="document">
              Documento (CPF)
            </label>
            <input
              class="shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
              id="cpf"
              name="cpf"
              type="text"
              placeholder="Apenas números"
              required
               />
            <span id="cpf-error" class="text-red-500"></span>
          </div>

          <div class="md:w-1/2">
            <label class="block text-blue-300 py-2 font-bold" for="phone">
              Telefone
            </label>
            <input
              class="shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
              id="phone"
              name="phone"
              type="text"
              placeholder="Apenas números"
              required
               />
          </div>
        </div>

        <!-- 4 ROW -->
        <div class="mb-4">
          <div class="">
            <label class="block text-blue-300 py-2 font-bold" for="amount">
              Valor de Depósito (USD)
            </label>
            <input
              class="shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
              id="amount"
              name="amount"
              type="number"
              placeholder="min $50.00 - max $10000.00"
              min="50.00"
              max="10000.00"
              required
            />
          </div>
        </div>

        <!-- BUTTON -->
        <div class="flex items-center justify-between pt-4 bg-gray-900 opacity-75 w-full shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
          <button
            id="submit-button"
            class="w-full bg-gradient-to-tr from-green-600 via-sky-600 to-teal-200 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
            type="submit"
          >
            Realizar pagamento
          </button>
        </div>
      </form>
      <!-- FORM ENDS -->

    </div>

    <!--Right Col-->
    <div class="flex flex-col w-full md:mt-10 xl:w-1/5 justify-center lg:items-end overflow-y-hidden">
      <h1 class="mt-4 text-3xl md:text-3xl text-white opacity-75 font-bold leading-tight text-center md:text-left">
        Total
      </h1>

      <form class="bg-gray-900 opacity-70 w-full shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
          <label class="block text-blue-300 py-2 font-bold mb-2" for="mirrorAmount">
            Pagamento em BRL
          </label>
          <input
            class="shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out disabled:text-white"
            id="mirrorAmount"
            name="mirrorAmount"
            type="text"
            disabled
              />
              <p class="pt-8 text-xs text-justify">
                Ao clicar em <b>Realizar Pagamento</b> você aceita os termos e condições do serviço. Se você tiver algum problema com o pagamento, entre em contato com suporte da <a href="https://thebrokerscapital.com/contato/" target="new_blank"><strong>The Brokers Capital<strong></a>.
              </p>
        </div>

      </form>
    </div>

    <!--Footer-->
    <div class="w-full pt-12 pb-1 text-sm text-center md:text-left fade-in">
      <a class="text-gray-500 no-underline hover:no-underline" href="#">&copy; The Brokers Capital 2023 - Powered by</a>
      <a href="https://midoricapital.com.br" target="new_blank"><strong> Midori Capital</strong></a>
    </div>
  </div>
</div>

  <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Input Mask -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

  <!-- Custom JavaScript -->
  <script src="public/js/currency.js"></script>
  <script src="public/js/mask.js"></script>

</body>
</html>
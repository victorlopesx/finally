<?php

$payload = isset($_GET['payload']) ? htmlspecialchars($_GET['payload']) : '';

// Verificar se o payload está vazio
if (empty($payload)) {
    // O payload está vazio, redirecionar para o index.php ou exibir uma mensagem de erro
    header("Location: https://midoricapital.com.br");
    exit;
}

// Se chegou aqui, significa que o usuário acessou a página corretamente
// O restante do código da página continua abaixo

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/app/Pix/pix.config.php';

use \App\Pix\Payload;
use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;

$payloadQrCode = htmlspecialchars($_GET['payload']);
$obQrCode = new QrCode($payloadQrCode);
$image = (new Output\Png)->output($obQrCode, 400);

$redirectUrl = 'https://midoricapital.com.br';
$redirectDelay = 180;
header("refresh:{$redirectDelay};url={$redirectUrl}");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
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
    </style>
  </head>

  <body class="leading-normal tracking-normal text-indigo-400 m-2 bg-cover bg-fixed" style="background-image: url('https://i.ibb.co/Y8vJQpG/header.png');">
    <div class="h-full">
      <!--Nav-->
      <nav class="bg-gray-900 drop-shadow-lg opacity-70 w-full">
      <div class="w-full mx-auto container">
        <div class="w-full flex items-center justify-between">
          <a class="flex items-center text-indigo-400 no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="#">
           <span class="bg-clip-text text-transparent bg-gradient-to-tr from-green-600 via-sky-600 to-teal-200">Midori Capital</span>
          </a>

          <div class="flex w-1/2 justify-end content-center p-2">
            <a href="https://thebrokerscapital.com" target="new_blank"><img class="md:h-12" src="https://thebrokerscapital.com/wp-content/uploads/2019/09/cropped-logobrk-300x99.png"></a>
          </div>
        </div>
      </div>
      </nav>

      <!--Main-->
      <div class="container pt-14 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden">
          <h1 class="my-4 text-3xl md:text-5xl text-white opacity-75 font-bold leading-tight text-center md:text-left">
            Sua
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-pink-500 to-purple-500">
              cobrança
            </span>
            foi gerada!
          </h1>
          <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left">
            Aponte a câmera do seu celular para o QR Code ou copie o código abaixo.
          </p>

          <form class="bg-gray-900 opacity-75 w-full shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
              <label class="block text-blue-300 py-2 font-bold mb-2" for="emailaddress">
                PIX Copia & Cola
              </label>
              <input
                class="shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
                id="emailaddress"
                type="text"
                placeholder="Não foi possível obter o código"
                value="<?=$payloadQrCode?>"
              />
            </div>

            <div class="flex items-center justify-between pt-4">
              <button
                class="bg-gradient-to-r from-purple-800 to-green-500 hover:from-pink-500 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
                type="button"
              >
                Copiar
              </button>
            </div>
          </form>
        </div>

        <!--Right Col-->
        <div class="w-full xl:w-3/5 p-12 overflow-hidden">
          <img class="mx-auto w-full md:w-80" src="data:image/png;base64, <?php echo base64_encode($image); ?>" />
        </div>

        <!--Footer-->
        <div class="w-full pt-12 pb-1 text-sm text-center md:text-left fade-in">
          <a class="text-gray-500 no-underline hover:no-underline" href="#">&copy; The Brokers Capital 2023 - Powered by</a>
          <a href="https://midoricapital.com.br" target="new_blank">Midori Capital</a>
        </div>
      </div>
    </div>
  </body>
</html>
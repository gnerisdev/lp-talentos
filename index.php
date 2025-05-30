<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$to = "gnerisdev@gmail.com"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name   = htmlspecialchars(trim($_POST["name"]));
  $phone  = htmlspecialchars(trim($_POST["phone"]));
  $email  = htmlspecialchars(trim($_POST["email"]));
  $area   = htmlspecialchars(trim($_POST["area"]));
  $resume = $_FILES["resume"];

  if (empty($name) || empty($phone) || empty($email) || empty($area) || empty($resume['name'])) {
    echo "<script>alert('Todos os campos são obrigatórios.'); history.back();</script>";
    exit();
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('E-mail inválido.'); history.back();</script>";
    exit();
  }

  $subject = "Novo formulário enviado";
  $body = "Nome: $name\n";
  $body .= "Telefone: $phone\n";
  $body .= "E-mail: $email\n";
  $body .= "Área de interesse: $area\n";

  try {
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->Host = 'smtp.zoho.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'contato@gnerisdev.com';
    $mail->Password = 'aCDPA5MpWPTK';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->setFrom('contato@gnerisdev.com', 'Formulário Landing Page Talentos');
    $mail->addAddress($to, 'Você');
    $mail->addReplyTo($email, $name);
    $mail->isHTML(false); 
    $mail->Subject = $subject;
    $mail->Body    = $body;

    // File
    if (is_uploaded_file($resume['tmp_name'])) {
      $mail->addAttachment($resume['tmp_name'], $resume['name']);
    }

    // Send
    if ($mail->send()) {
      echo "Formulário enviado com sucesso!";
      header("Location: gratitude.php");
    } else {
      echo "<script>alert('Erro ao enviar o formulário. Tente novamente.');</script>";
      exit();
    }
  } catch (Exception $e) {
    echo "<script>alert('Erro ao enviar o formulário. Tente novamente.');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="./assets/images/grupo360-logo.png">
  <title>Grupo 360</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./assets/styles/index.css">

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MZV5885C');
  </script>
  <!-- End Google Tag Manager -->
  
  <!-- Meta Pixel Code -->
  <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '2629642227264129');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=2629642227264129&ev=PageView&noscript=1"
  /></noscript>
  <!-- End Meta Pixel Code -->
</head>

<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MZV5885C"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  
  <main>
    <section id="section-hero" class="section-hero">
      <div class="container">
        <div class="section-hero__content">
          <div>
            <img class="section-hero__logo" src="./assets/images/grupo360-logo.png" alt="Logo grupo 360">
            <h2>
              <strong>Conecte-se à inovação:</strong> faça parte <br>
              do nosso banco de talentos!
            </h2>
          </div>
          <a href="#content-form" class="section-hero__button">INSCREVA-SE</a>
        </div>
      </div>
      <div class="section-hero__background"></div>
    </section>

    <section id="section-about" class="section-about">
      <div class="container">
        <div class="section-about__container">
          <div class="section-about__image-wrapper">
            <img src="./assets/images/17c3c7f338086a5e33df1d4fecad5926.jpeg" alt="Foto de colaboradora sorrindo" class="section-about__image" />
          </div>

          <div class="section-about__content">
            <h2 class="section-about__title">NOSSA HISTÓRIA</h2>
            <p class="section-about__text">
              O <strong>Grupo 360°</strong> nasceu da união de expertise e inovação. Formado em 2020 pela integração da IU360, fundada em 2014, e da Cative
              Comunicação, criada em 2013, fomos pioneiros no Brasil ao combinar Inteligência de Dados e Marketing Digital em um único ecossistema.
            </p>
            <p class="section-about__text">
              Com a IU360, transformamos dados em decisões estratégicas, e a Cative potencializa vendas por meio de <strong>estratégias avançadas de tráfego
                pago e funil de conversão</strong>. Agora, com a AutoNegocie, expandimos nosso alcance, trazendo inovação ao mercado de gestão de bens e revenda
              de automóveis com débitos.
            </p>
            <p class="section-about__text">
              Juntos, criamos soluções que impulsionam resultados e moldam o futuro do mercado digital. E para continuarmos essa jornada, buscamos pessoas
              talentosas e apaixonadas pelo que fazem. Se você quer crescer profissionalmente e atuar em um ambiente dinâmico e inovador, <strong>inscreva-se no
                nosso Banco de Talentos!</strong>
            </p>

            <div class="section-about__logos">
              <img src="./assets/images/logo-cative-comunicação.png" alt="Logo Cative" class="section-about__logo" />
              <img src="./assets/images/logo-auto-negocie.png" alt="Logo AutoNegocie" class="section-about__logo" />
              <img src="./assets/images/logo-360.png" alt="Logo Grupo 360" class="section-about__logo" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="section-areas" class="section-areas">
      <div class="section-areas__container">
        <h2 class="section-areas__title title">Nossas áreas</h2>
        <ul class="section-areas__list">
          <li class="section-areas__item">
            <svg width="29px" height="29px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#FC6F03"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12.0002C5.50024 8.66068 7.85944 5.78639 11.1348 5.1351C14.4102 4.48382 17.6895 6.23693 18.9673 9.32231C20.2451 12.4077 19.1655 15.966 16.3887 17.8212C13.6119 19.6764 9.91127 19.3117 7.55 16.9502C6.23728 15.6373 5.49987 13.8568 5.5 12.0002Z" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 12.0002L11.333 14.3332L16 9.66724" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            Atendimento e Relacionamento
          </li>
          <li class="section-areas__item">
            <svg width="29px" height="29px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#FC6F03"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12.0002C5.50024 8.66068 7.85944 5.78639 11.1348 5.1351C14.4102 4.48382 17.6895 6.23693 18.9673 9.32231C20.2451 12.4077 19.1655 15.966 16.3887 17.8212C13.6119 19.6764 9.91127 19.3117 7.55 16.9502C6.23728 15.6373 5.49987 13.8568 5.5 12.0002Z" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 12.0002L11.333 14.3332L16 9.66724" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            Estratégia
          </li>
          <li class="section-areas__item">
            <svg width="29px" height="29px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#FC6F03"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12.0002C5.50024 8.66068 7.85944 5.78639 11.1348 5.1351C14.4102 4.48382 17.6895 6.23693 18.9673 9.32231C20.2451 12.4077 19.1655 15.966 16.3887 17.8212C13.6119 19.6764 9.91127 19.3117 7.55 16.9502C6.23728 15.6373 5.49987 13.8568 5.5 12.0002Z" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 12.0002L11.333 14.3332L16 9.66724" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            Compras
          </li>
          <li class="section-areas__item">
            <svg width="29px" height="29px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#FC6F03"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12.0002C5.50024 8.66068 7.85944 5.78639 11.1348 5.1351C14.4102 4.48382 17.6895 6.23693 18.9673 9.32231C20.2451 12.4077 19.1655 15.966 16.3887 17.8212C13.6119 19.6764 9.91127 19.3117 7.55 16.9502C6.23728 15.6373 5.49987 13.8568 5.5 12.0002Z" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 12.0002L11.333 14.3332L16 9.66724" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            Social Media
          </li>
          <li class="section-areas__item">
            <svg width="29px" height="29px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#FC6F03"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12.0002C5.50024 8.66068 7.85944 5.78639 11.1348 5.1351C14.4102 4.48382 17.6895 6.23693 18.9673 9.32231C20.2451 12.4077 19.1655 15.966 16.3887 17.8212C13.6119 19.6764 9.91127 19.3117 7.55 16.9502C6.23728 15.6373 5.49987 13.8568 5.5 12.0002Z" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 12.0002L11.333 14.3332L16 9.66724" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            Design
          </li>
          <li class="section-areas__item">
            <svg width="29px" height="29px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#FC6F03"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12.0002C5.50024 8.66068 7.85944 5.78639 11.1348 5.1351C14.4102 4.48382 17.6895 6.23693 18.9673 9.32231C20.2451 12.4077 19.1655 15.966 16.3887 17.8212C13.6119 19.6764 9.91127 19.3117 7.55 16.9502C6.23728 15.6373 5.49987 13.8568 5.5 12.0002Z" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 12.0002L11.333 14.3332L16 9.66724" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            Tecnologia e Dados
          </li>
          <li class="section-areas__item">
            <svg width="29px" height="29px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#FC6F03"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12.0002C5.50024 8.66068 7.85944 5.78639 11.1348 5.1351C14.4102 4.48382 17.6895 6.23693 18.9673 9.32231C20.2451 12.4077 19.1655 15.966 16.3887 17.8212C13.6119 19.6764 9.91127 19.3117 7.55 16.9502C6.23728 15.6373 5.49987 13.8568 5.5 12.0002Z" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 12.0002L11.333 14.3332L16 9.66724" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            Copywriting
          </li>
          <li class="section-areas__item">
            <svg width="29px" height="29px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#FC6F03"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12.0002C5.50024 8.66068 7.85944 5.78639 11.1348 5.1351C14.4102 4.48382 17.6895 6.23693 18.9673 9.32231C20.2451 12.4077 19.1655 15.966 16.3887 17.8212C13.6119 19.6764 9.91127 19.3117 7.55 16.9502C6.23728 15.6373 5.49987 13.8568 5.5 12.0002Z" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 12.0002L11.333 14.3332L16 9.66724" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            Recursos Humanos
          </li>
          <li class="section-areas__item">
            <svg width="29px" height="29px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#FC6F03"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12.0002C5.50024 8.66068 7.85944 5.78639 11.1348 5.1351C14.4102 4.48382 17.6895 6.23693 18.9673 9.32231C20.2451 12.4077 19.1655 15.966 16.3887 17.8212C13.6119 19.6764 9.91127 19.3117 7.55 16.9502C6.23728 15.6373 5.49987 13.8568 5.5 12.0002Z" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 12.0002L11.333 14.3332L16 9.66724" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            Comercial
          </li>
          <li class="section-areas__item">
            <svg width="29px" height="29px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#FC6F03"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12.0002C5.50024 8.66068 7.85944 5.78639 11.1348 5.1351C14.4102 4.48382 17.6895 6.23693 18.9673 9.32231C20.2451 12.4077 19.1655 15.966 16.3887 17.8212C13.6119 19.6764 9.91127 19.3117 7.55 16.9502C6.23728 15.6373 5.49987 13.8568 5.5 12.0002Z" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 12.0002L11.333 14.3332L16 9.66724" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            Foto e vídeo
          </li>
          <li class="section-areas__item">
            <svg width="29px" height="29px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#FC6F03"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12.0002C5.50024 8.66068 7.85944 5.78639 11.1348 5.1351C14.4102 4.48382 17.6895 6.23693 18.9673 9.32231C20.2451 12.4077 19.1655 15.966 16.3887 17.8212C13.6119 19.6764 9.91127 19.3117 7.55 16.9502C6.23728 15.6373 5.49987 13.8568 5.5 12.0002Z" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 12.0002L11.333 14.3332L16 9.66724" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            Financeiro
          </li>
          <li class="section-areas__item">
            <svg width="29px" height="29px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#FC6F03"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12.0002C5.50024 8.66068 7.85944 5.78639 11.1348 5.1351C14.4102 4.48382 17.6895 6.23693 18.9673 9.32231C20.2451 12.4077 19.1655 15.966 16.3887 17.8212C13.6119 19.6764 9.91127 19.3117 7.55 16.9502C6.23728 15.6373 5.49987 13.8568 5.5 12.0002Z" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 12.0002L11.333 14.3332L16 9.66724" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            Automação e CRM
          </li>
          <li class="section-areas__item">
            <svg width="29px" height="29px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#FC6F03"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12.0002C5.50024 8.66068 7.85944 5.78639 11.1348 5.1351C14.4102 4.48382 17.6895 6.23693 18.9673 9.32231C20.2451 12.4077 19.1655 15.966 16.3887 17.8212C13.6119 19.6764 9.91127 19.3117 7.55 16.9502C6.23728 15.6373 5.49987 13.8568 5.5 12.0002Z" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 12.0002L11.333 14.3332L16 9.66724" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            Tráfego Digital
          </li>
          <li class="section-areas__item">
            <svg width="29px" height="29px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#FC6F03"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12.0002C5.50024 8.66068 7.85944 5.78639 11.1348 5.1351C14.4102 4.48382 17.6895 6.23693 18.9673 9.32231C20.2451 12.4077 19.1655 15.966 16.3887 17.8212C13.6119 19.6764 9.91127 19.3117 7.55 16.9502C6.23728 15.6373 5.49987 13.8568 5.5 12.0002Z" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 12.0002L11.333 14.3332L16 9.66724" stroke="#FC6F03" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            Marketing
          </li>
        </ul>
      </div>
    </section>   
    
    <section id="section-testimonials" class="section-testimonials">
      <div class="section-testimonials__video-container container">
        <div class="section-testimonials__wrapper-title"  id="section-testimonials-desktop">
          <h2 class="section-testimonials__title title-decoration">Depoimentos</h2>
        </div>

        <div class="section-testimonials__video-wrapper">
        <div class="section-testimonials__videos">
          <div class="section-testimonials__video-item">
            <div id="vid_67f96c0d6531e7d90eac4963" style="position: relative; width: 100%; padding: 177.77777777777777% 0 0;"> 
              <img id="thumb_67f96c0d6531e7d90eac4963" src="https://images.converteai.net/d5fc372b-928b-4d66-b772-7d4a3280f023/players/67f96c0d6531e7d90eac4963/thumbnail.jpg" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; display: block;" alt="thumbnail"> 
              <div id="backdrop_67f96c0d6531e7d90eac4963" style=" -webkit-backdrop-filter: blur(5px); backdrop-filter: blur(5px); position: absolute; top: 0; height: 100%; width: 100%; "></div> 
            </div>
          </div>
          <div class="section-testimonials__video-item"> 
            <img src="./assets/images/preview-video.png" />
          </div>
          <div class="section-testimonials__video-item">
            <img src="./assets/images/preview-video.png" />
          </div>
        </div>  
      </div>
    </section>  

    <section id="section-testimonials__quotes" class="section-testimonials__quotes">
      <div class="container">
        <h3 class="section-testimonials__subtitle">O que nossos profissionais dizem</h3>
        <div class="section-testimonials__cards">
          <div class="section-testimonials__card">
            <img src="./assets/images/profile-laura.jpg" class="profile" alt="">
            <p class="section-testimonials__text">
              "Trabalhar aqui foi uma experiência incrível! O ambiente é acolhedor e repleto de oportunidades para crescer."
              <br> <br> <span>Laura Ribeiro</span>
            </p>
          </div>
          <div class="section-testimonials__card">
            <img src="./assets/images/profile-joao.jpg" class="profile" alt="">
            <p class="section-testimonials__text">
              "A cultura da empresa valoriza feedbacks e criatividade. Me sinto desafiado e motivado todos os dias."
              <br> <br> <span>João Soares</span>
            </p>
          </div>
          <div class="section-testimonials__card">
            <img src="./assets/images/profile-viviane.jpg" class="profile" alt="">
            <p class="section-testimonials__text">
              "Desde que entrei no Grupo 360, me desenvolvi como nunca. Um excelente lugar para crescer pessoal e profissionalmente."
              <br> <br> <span>Viviane Machado</span>
            </p>
          </div>
        </div>
      </div>
    </section>

    <section id="section-form" class="section-form">
      <div class="container">
        <h2 class="section-form__title">Cadastre-se no nosso banco de talentos</h2>
        <div id="content-form" class="section-form__content">
          <form method="POST" enctype="multipart/form-data">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name"  placeholder="Seu nome completo" />
        
            <label for="phone">Telefone</label>
            <input type="text" id="phone" name="phone" placeholder="(00) 00000-0000" />
        
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="seu@email.com" />
        
            <label for="area">Área de interesse</label>
            <select id="area" name="area">
              <option>Selecione uma área</option>
              <option value="atendimento_e_relacionamento">Atendimento e Relacionamento</option>
              <option value="social_media">Social Media</option>
              <option value="copywriting">Copywriting</option>
              <option value="videomaker">VideoMaker</option>
              <option value="trafego_digital">Tráfego Digital</option>
              <option value="estrategia">Estratégia</option>
              <option value="design">Design</option>
              <option value="recursos_humanos">Recursos Humanos</option>
              <option value="financeiro">Financeiro</option>
              <option value="marketing">Marketing</option>
              <option value="compras">Compras</option>
              <option value="tecnologia_e_dados">Tecnologia e Dados</option>
              <option value="comercial">Comercial</option>
              <option value="automacao_e_crm">Automação e CRM</option>
            </select>
        
            <label for="resume">Currículo</label>
            <div id="custom-input-file">
              <span id="file-label">Escolher arquivo</span>
              <input type="file" id="resume" name="resume" />
            </div>
                    
            <button type="submit">ENVIAR</button>
          </form>
        </div>        
      </div>
    </section>
  </main>

  <footer id="footer" class="footer">
    <div class="container">
      <div class="footer__content">
        <p>
          Open Mall The Square <br>
          <span>Bloco F - SP-270, 22 - Parque Frondoso, Cotia - SP, 06709-015, Sala 408/409</span>
        </p>
      </div>
      <p class="footer_copyright">
        ©COPYRIGHT 2025 – Cative Comunicação – Todos os direitos reservados.
      </p>
    </div>
  </footer>

  <script type="text/javascript" id="scr_67f96c0d6531e7d90eac4963"> 
    var s=document.createElement("script"); s.src="https://scripts.converteai.net/d5fc372b-928b-4d66-b772-7d4a3280f023/players/67f96c0d6531e7d90eac4963/player.js", s.async=!0,document.head.appendChild(s); 
  </script>

  <script>
    const form = document.querySelector('.section-form form');
    const input = document.getElementById('resume');
    const label = document.getElementById('file-label');

    input.addEventListener('change', function () {
      if (this.files.length > 0) {
        label.textContent = this.files[0].name;
      } else {
        label.textContent = 'Escolher arquivo';
      }
    });

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      const name = document.getElementById('name');
      const phone = document.getElementById('phone');
      const email = document.getElementById('email');
      const area = document.getElementById('area');
      const resume = document.getElementById('resume');

      let errors = [];

      // Nome
      if (name.value.trim() === '') {
        errors.push('Preencha o nome');
      } else if (!validateFullName(name.value)) {
        errors.push('Digite seu nome completo');
      }

      // Telefone
      if (phone.value.trim() === '') { 
        errors.push('Preencha o telefone');
      }

      // Email
      if (email.value.trim() === '') {
        errors.push('Preencha o e-mail');
      } else if (!validateEmail(email.value)) {
        errors.push('E-mail inválido');
      }

      // Área de interesse
      if (area.value === '' || area.selectedIndex === 0) {
        errors.push('Selecione uma área de interesse');
      }

      // Currículo
      if (resume.files.length === 0) {
        errors.push('Anexe seu currículo');
      }

      if (errors.length > 0) {
        alert(errors.join('\n'));
      } else {
        form.submit();
      }
    });

    function validateEmail(email) {
      const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      return re.test(email.toLowerCase());
    }

    function validateFullName(name) {
      const parts = name.trim().split(' ');
      return parts.length >= 2 && parts.every(part => part.length > 1);
    }
  </script> 
</body>
</html>
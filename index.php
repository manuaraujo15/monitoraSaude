<?php
	date_default_timezone_set('America/Sao_Paulo');

				
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require './lib/vendor/autoload.php';

	if((isset($_POST['email']) && !empty(trim($_POST['email']))) && (isset($_POST['mensagem']) && !empty(trim($_POST['mensagem'])))) {

		$nome = !empty($_POST['nome']) ? $_POST['nome'] : 'Não informado';
		$email = $_POST['email'];
		$assunto = !empty($_POST['assunto']) ? utf8_decode($_POST['assunto']) : 'Não informado';
		$mensagem = $_POST['mensagem'];
		$data = date('d/m/Y H:i:s');
		$mail = new PHPMailer(true);
 
	try {
		$mail->CharSet = 'UTF-8';
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.mailtrap.io';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = '01fe8b8bcab804';
                    $mail->Password   = '011d885d0c2ea6';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 2525;


		$mail->setFrom('esaude.suportecliente@gmail.com','Suporte ao cliente');
		$mail->addAddress($email,'$nome');

		$mail->isHTML(true);
		$mail->Subject = "Formulario de contato, assunto:{$assunto}";
		$mail->Body = "Nome: {$nome}<br>
					   Email: {$email}<br>
					   Mensagem: {$mensagem}<br>
					   Data/hora: {$data}";
		$mail->send();
		if($mail->send()) {
		$_SESSION['campo_sucesso'] ='Email enviado com sucesso.';
		} else {
		$_SESSION['nao_enviado'] = 'Email não enviado.';}
		
	} catch (Exception $e) {
	echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
	}
	}else {
			$_SESSION['campo_vazio'] =  "Não enviado: informar o email e a mensagem!";
		}
	

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Monitora Saúde</title>
    <meta charset="utf-8">
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,700,1,200" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="vendor/aos/aos.css" rel="stylesheet">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
   
    <!-- owl carousel css-->
    
    
  <link href="css/stylee.css" rel="stylesheet">

  </head>
  <body>
 <?php include 'header-novo.php';?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-4 d-flex flex-column justify-content-center pt-4  order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>A melhor solução para o monitoramento da sua saúde</h1>
          <h2>O site para você cuidar e prevenir sua vida</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="cad_usuario.php" class="btn-get-started scrollto">Entre ou Cadastre-se</a>
            <a href="" class="glightbox btn-watch-video"><i class="bi bi-play-circle">
			</i><span>Tutorial</span></a>
          </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-1 order-1 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="img/b3.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
      <div class="container-fluid" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

            <div class="content">
              <h3>Para que  <strong>monitorar a saúde:</strong></h3>
              <p>
				O monitoramento  significa uma coleta e análise de informações regular e sistematicamente para identificar o bom andamento de um projeto ou sistema bem como possíveis alterações em sua rotina ao longo do tempo. 
				Por isso, é benefico para prevenir inúmeros problemas, além de solucionar rapidamente muitos outros.
              </p>
            </div>

            <div class="accordion-list">
              <ul>
                <li>
                  <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1">
				  <span>01</span> Monitoramento da Saúde <i class="bx bx-chevron-down icon-show"></i>
				  <i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                    <p>
                     Ao fazer o monitoramento da saúde, 
					 é possível ter um diagnóstico antecipado de problemas que podem se agravar no futuro.

                    </p>
                  </div>
                </li>

                <li>
                  <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed">
				  <span>02</span> Diagnóstico Antecipado <i class="bx bx-chevron-down icon-show"></i>
				  <i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                    <p>
                     Melhor do que ter um diagnóstico precoce, é evitar o surgimento de doenças. Para esse momento, 
					 é necessário avaliar ainda o histórico do paciente – por isso é importante fazer o monitoramento da saúde 
					 – a fim atrair a sua participação para programas de medicina preventiva que tenham temas de interesse e que sejam relevantes para esse beneficiário.
                    </p>
                  </div>
                </li>

                <li>
                  <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed">
				  <span>03</span> Redução dos Gastos<i class="bx bx-chevron-down icon-show"></i>
				  <i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                    <p>
                    Os gastos com a saúde terá redução de custos com tratamentos de doenças que podem ser evitadas e prevenidas.
					Esse é o principal motivo pelo qual nós, os gestores, buscamos o monitoramento da saúde dos beneficiários.

                    </p>
                  </div>
                </li>

              </ul>
            </div>

          </div>

          <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='  background-image: url("img/why-uss.png"); ' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
            <img src="img/skills.png" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
            <h3>O que o E-Saúde oferece?</h3>
            <p class="fst-italic">
             O E-Saúde oferece praticidade e independência aos beneficiários.

            </p>

            <div class="skills-content">

              <div class="progress">
                <span class="skill">Comparação de exames <i class="val">100%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="progress">
                <span class="skill">Visual interativo <i class="val">100%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="progress">
                <span class="skill">Gráficos ilustrativos <i class="val">100%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="progress">
                <span class="skill">Gratuito <i class="val">100%</i></span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

            </div>

          </div>
        </div>

      </div>
    </section><!-- End Skills Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Benefícios do site E-Saúde</h2>
          <p>Este sistema facilita as consultas à distância, ou seja, permite cuidados de saúde para pessoas que estiverem em lugares remotos ou com um limitado acesso aos serviços de saúde.
		  Além disso, significa uma poupança de tempo, despesas e deslocamentos tanto para médicos como para pacientes.</p>
        </div>

        <div class="row">
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-browser-chrome"></i></div>
              <h4><a href="">Um local para todos seus exames</a></h4>
              <p>Uso descomplicado do acesso à seus seus exames</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="">Análise Diferenciada</a></h4>
              <p> O site possibilita uma análise sistemática para uma fácil compreensão dos beneficiários e pessoas da comunidade da saúde</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-bar-chart-line"></i></div>
              <h4><a href="">Tabela Dinâmica</a></h4>
              <p>Acesso a uma tabela dinâmica com seus exames, ao longo do tempo, isto é, um banco de dados de fácil visualização </p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-emoji-smile"></i></div>
              <h4><a href="">Acessível</a></h4>
              <p>E-Saúde é um site acessível aos idosos, contando com uma interface gráfica limpa, intuitiva e facilmente usual para o dia a dia </p>
            </div>
          </div>

        </div>

      </div>
<?php include 'noticias.html';?>
  <section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Nosso Time</h2>
          <p>As desenvolvedoras desse projeto são alunas do ensino médio técnico, que escolheram o tema de monitoramento de saúde como tema de TCC</p>
        </div>

        <div class="row">

          <div class="col-lg-6">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
              <div class="pic"><img src="" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Emanuele Fernanda Ferraz de Araújo</h4>
                <span>Desenvolvedora e escritora</span>
                <p>Aluna do 4º ano do ensino médio com tecnico de informática integrado, do IFPR campus Pinhais  </p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4 mt-lg-0">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="200">
              <div class="pic"><img src="" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Juliana Gonçalves Nascimento</h4>
                <span>Desenvolvedora e escritora</span>
                <p>Aluna do 4º ano do ensino médio com tecnico de informática integrado, do IFPR campus Pinhais</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class=" col-lg-3 offset-lg-3 col-sm-6 offset-sm-6 col-md-6 offset-md-6 w-md-50 w-50 w-lg-100 w-sm-100 mt-4 ">
            <div class=" member d-flex align-items-center" data-aos="zoom-in" data-aos-delay="300">
              <div class="pic"><img src="" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Julia Helena Paes Cardoso</h4>
                <span>Desenvolvedora e escritora</span>
                <p>Aluna do 4º ano do ensino médio com tecnico de informática integrado, do IFPR campus Pinhais</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Team Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Perguntas Frequentes</h2>
          <p></p>
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">O site é totalmente gratuito? <i class="bx bx-chevron-down icon-show"></i>
			  <i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                <p>
                  Sim, o E-Saúde é totalmente gratuito para que toda a população, independente da condição financeira, consiga ter o acesso para monitorar seus exames clínicos.
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">É seguro? <i class="bx bx-chevron-down icon-show"></i>
			  <i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Sim, as desenvolvedoras desse projeto usaram os melhores métodos para deixar seus dados seguros.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Como funciona? <i class="bx bx-chevron-down icon-show"></i>
			  <i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list"> 
			
                <p >
                  Temos um vídeo de tutorial do E-SAÚDE simples e rápido para você clique abaixo para ver! 
                </p>
				<a  style="margin-left:-3%; " href="">clique aqui</a>
              </div>
            </li>
			<li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Como faço para falar om as desenvolvedoras? <i class="bx bx-chevron-down icon-show"></i>
			  <i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                <p>
                   As desenvolvedoras respondem pelo email esaude.suportecliente@gmail.com, mas também no formulário de contato abaixo
                </p>
              </div>
            </li>
            

          </ul>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->
	
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
      <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contato</h2>
          <p>Envie uma sugestão ou pergunta</p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Localização:</h4>
                <p>R. Humberto de A. C. Branco, 1575 - Jardim Amélia, Pinhais - PR, 83330</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>esaude.suportecliente@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Telefone:</h4>
                <p>(41) 3375-4970</p>
              </div>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3603.4201590865187!2d-49.16534098503357!3d-25.424212983791094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94dcee52d561a8f3%3A0x39a922bff7fb471f!2sInstituto%20Federal%20do%20Paran%C3%A1%20Campus%20Pinhais!5e0!3m2!1spt-BR!2sbr!4v1665067052172!5m2!1spt-BR!2sbr" 
					frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
              
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="index.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Seu Nome</label>
                  <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Seu Email</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Assunto</label>
                <input type="text" class="form-control" name="assunto" id="assunto" required>
              </div>
              <div class="form-group">
                <label for="name">Mensagem</label>
                <textarea class="form-control" name="mensagem" rows="10" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Enviar mensagem</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->
  <footer id="footer">

   

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3  id="h3-footer"> <img src="logo11.png" id="logo-footer">E-Saúde</h3>
              <p id="p-footer"><strong id="strong-footer">Email:</strong> esaude.suportecliente@gmail.com<br> </p>           
          </div>
        </div>
      </div>
    </div>   
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="vendor/aos/aos.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/glightbox/js/glightbox.min.js"></script>
  <script src="vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="js/main.js"></script>


  </body>

</html>
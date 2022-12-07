<?php
class FormValidate
{
    public $error = false;

    private function handleErrors()
    {
        if (!isset($_POST) || empty($_POST)) {
            $this->error = 'Nothing has been posted...';
        }
        foreach ($_POST as $key => $value) {
            $$key = trim(strip_tags($value));
            if (empty($value)) {
                $this->error = 'Blank spaces posted...';
            }
        }
        if ((!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) && !$this->error) {
            $this->error = 'Send a valid email...';
        }
        return $this->error;
    }

    public function createMesssage()
    {
        if(!$this->handleErrors()){
            $formName = addslashes($_POST["personname"]);
            $formEmail = addslashes($_POST["personmail"]);
            $formMessage = addslashes($_POST["personmessage"]);

            $to = "alucardloko3900@gmail.com";
            $subject = "Sistema solar interativo - Formulário";
            $body = "Nome: $formName \r\n
            Email: $formEmail \r\n
            Mensagem: $formMessage";

            $header = "From: " . $formEmail . "\r\n"
                . "Reply-To: " . $formEmail . "\r\n"
                . " x=Mailer:PHP/" . phpversion();

            return array($to, $subject, $body, $header);
        }
        return false;
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Solar System Info - Submited form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" media="screen" href="homepage.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Oswald&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato&display=swap"
      rel="stylesheet"
    />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <div class="spaceBackground">
      <input type="checkbox" id="active" />
      <label for="active" class="menu-btn"><span></span></label>
      <label for="active" class="close"></label>
      <div class="wrapper">
        <ul>
          <li>
            <a
              onclick="transitionToPage('solarsystem.html')"
              style="cursor: pointer"
              >Explore</a
            >
          </li>
          <li>
            <a onclick="transitionToPage('index.html')" style="cursor: pointer"
              >Home</a
            >
          </li>
          <li>
            <a onclick="transitionToPage('form.html')" style="cursor: pointer"
              >Feedback</a
            >
          </li>
          <li>
            <a href="https://github.com/GuiTaglietti" target="_blank">Github</a>
          </li>
        </ul>
      </div>
      <div class="content">
        <div class="containerText">
          <h1 contenteditable class="titleAbout">Feedback message</h1>
            <?php
                $f = new FormValidate();
                $key = $f->createMesssage();
                if(!$key){
                    echo "<p>";
                    echo "Error found: " . $f->error;
                    echo "</p>";
                }
                else{
                    if(mail($key[0], $key[1], $key[2], $key[3])){
                        echo "<p>";
                        echo "Thanks for your contribution!";
                        echo "</p>";
                    }
                    else{
                        echo "<p>";
                        echo "Error: Message was not sent! Please try again...";
                        echo "<p>";
                    }
                }
            ?>
        </div>
      </div>
    </div>
    <script src="main.js"></script>
  </body>
</html>

<?php
class FormValidate
{
    public function createMesssage()
    {
        $formName = filter_input(INPUT_POST, "personname", FILTER_SANITIZE_SPECIAL_CHARS);
        $formEmail = filter_input(INPUT_POST, "personmessage", FILTER_SANITIZE_SPECIAL_CHARS);
        $formMessage =filter_input(INPUT_POST, "personmail", FILTER_SANITIZE_SPECIAL_CHARS);
        if($formName && $formEmail && $formMessage){
            $to = "192370@upf.br";
            $subject = "Sistema solar interativo - Formulário";
            $body = "Name: $formName \r\n
            Email: $formEmail \r\n
            Message: $formMessage";

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
                $mail_array = $f->createMesssage();
                if($mail_array){
                    if(mail($mail_array[0], $mail_array[1], $mail_array[2], $mail_array[3])){
                        echo "<p>Thanks for your contribution!</p><br/>";
                    } else{
                        echo "<p>Error: Message cannot be sent</p><br/>";
                        echo "<p>Mail body: ". $mail_array[2] ."</p>";
                    }
                } else {
                    echo "<p>Error: Nothing has been posted!</p><br/>";
                }
            ?>
        </div>
        <span class="contButton"
          ><a
            onclick="transitionToPage('solarsystem.html')"
            style="cursor: pointer"
          ></a
        ></span>
      </div>
    </div>
    <script src="main.js"></script>
  </body>
</html>

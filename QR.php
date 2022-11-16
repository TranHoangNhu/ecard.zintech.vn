<!DOCTYPE html>
<html lang="en">
  <head>
    <!--
      This is the page head - it contains info the browser uses to display the page
      You won't see what's in the head in the page
      Scroll down to the body element for the page content
    -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      rel="shortcut icon"
      type="image/jpg"
      href="https://cdn.glitch.com/d08bb326-e251-4744-9266-f454d653c7c1%2Ffavicon.png?v=1624373448629"
    />

    <!-- Import the webpage's stylesheet -->
    <link rel="stylesheet" href="./css/qr/font.css" />
    <link rel="stylesheet" href="./css/qr/style.css" />
    <title></title> 
  </head>

  <body>
    <div id="app">
      <div id="card">
        <div id="overlay"></div>
        <div id="qr-code"></div>
      </div>

      <div id="form-card">
      </div>
    </div>

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"
      integrity="sha512-VKjwFVu/mmKGk0Z0BxgDzmn10e590qk3ou/jkmRugAkSTMSIRkd4nEnk+n7r5WBbJquusQEQjBidrBD3IQQISQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.js"
      integrity="sha512-is1ls2rgwpFZyixqKFEExPHVUUL+pPkBEPw47s/6NDQ4n1m6T/ySeDW3p54jp45z2EJ0RSOgilqee1WhtelXfA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script src="./js/qr/dom-to-image.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="./js/qr/script.js" defer></script>
  </body>
</html>

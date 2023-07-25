<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <Title>Feedback</Title>
    <link rel="stylesheet" href="feedstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="title">How we want to improve?</div>
        <form action="#" id="form">
            <div class="user-details">
                <div class="form-group">
                    First Name &nbsp;<br>
                    <input type="text" name="from_name" id="from_name" placeholder="Fist Name" required>
                </div>
                <div class="form-group">
                    <span class="details">Last Name &nbsp;</span><br>
                    <input type="text" name="text" id="text" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                    <span class="details">Phone Number &nbsp;</span><br>
                    <input type="text" name="phone" id="phone" placeholder="Phone Number" required>
                </div>
                <div class="form-group">
                    <span class="details">Email &nbsp;</span><br>
                    <input type="email" name="from_email" id="from_email" placeholder="Email" required>
                </div>
                <div style="position: absolute;bottom:140px;left:90px;">
                    <span class="details">Do you sastified with our services?</span><br><br>
                    <input type="radio" name="tahla" id="tahla" value="Yes"required> Yes
                    <input type="radio" style="visibility: hidden;">
                    <input type="radio" name="tahla" id="tahla" value="No"required> No
                </div>
                <div style="position: absolute;bottom:90px; right: 360px;" class="hhh"  id="em">
                    <span class="details">Tell Us About Your Idea</span><br>
                    <textarea type="text" name="message" id="message" cols="30" rows="6" res\\ placeholder="Remark" required></textarea>
                </div>
            </div>
            <button class="sub"> <input type="submit" id="button" value="Submit" style="border: none;" ></button>
        </form>
    </div>

    <!--<form id="form">
  <div class="field">
    <label for="from_name">from_name</label>
    <input type="text" name="from_name" id="from_name">
  </div>
  <div class="field">
    <label for="text">text</label>
    <input type="text" name="text" id="text">
  </div>
  <div class="field">
    <label for="from_email">from_email</label>
    <input type="text" name="from_email" id="from_email">
  </div>
  <div class="field">
    <label for="tahla">tahla</label>
     <input type="radio" name="tahla" id="tahla" value="Yes"> Yes
      <input type="radio" name="tahla" id="tahla" value="No"> No
  </div>
  <div class="field">
    <label for="phone">phone</label>
    <input type="text" name="phone" id="phone">
  </div>
  <div class="field">
    <label for="message">message</label>
    <input type="text" name="message" id="message">
  </div>

  <input type="submit" id="button" value="Send Email" >
</form>-->



    <script type="text/javascript">
        emailjs.init('uOl-6JtTfxNy3yNBq');
    </script>
</body>
<script>
    const btn = document.getElementById('button');

    document.getElementById('form')
        .addEventListener('submit', function(event) {
            event.preventDefault();

            btn.value = 'Sending...';

            const serviceID = 'default_service';
            const templateID = 'template_u9pk8ge';

            emailjs.sendForm(serviceID, templateID, this)
                .then(() => {
                    btn.value = 'Send Email';
                    alert('Sent!');
                    window.location.href = 'index.php';
                }, (err) => {
                    btn.value = 'Send Email';
                    alert(JSON.stringify(err));
                });

        });
</script>


</html>
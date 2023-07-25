<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
    <head>
        <style>
            #google_element select{
            border-radius: 50px;
            height: 30px;
            border-color: antiquewhite;
            text-align: center;

        }
        
        .goog-logo-link, .goog-te-gadget span{

             display:none !important;
        }

        .goog-te-gadget{
            color:transparent!important;
            font-size :0;
           
        }
        </style>
    </head>
</head>
<body>
<div id="google_element"></div>
    <script>  
        function loadGoogleTranslate(){
        new google.translate.TranslateElement("google_element")
    }
    </script>
</body>
</html>
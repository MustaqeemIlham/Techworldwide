
$(document).ready(function(){
    $('.count').prop('disabled', true);
       $(document).on('click','.plus',function(){
        $('.count').val(parseInt($('.count').val()) + 1 );
        $('span[class*="price[1]"]').text((parseInt($('.count').val())*3000).toFixed(2));
    });
    $(document).on('click','.minus',function(){
        $('.count').val(parseInt($('.count').val()) - 1 );
        $('span[class*="price[1]"]').text((parseInt($('.count').val())*2.5).toFixed(2));
            if ($('.count').val() == 0) {
                $('.count').val(1);
                $('span[class*="price[1]"]').text((parseInt($('.count').val())*2.5).toFixed(2));
            }
        });
 });

 /* <script>
          const countAll = document.querySelectorAll('.product-cart #img-container').length;
          document.querySelector('.price[0]').innerHTML = countAll;
        </script> */

        setInterval(function(){
            check_user();
        }, 2000);

        function check_user() {
            jQuery.ajax({
              url: 'user_auth.php',
              type: 'post',
              data: 'type=ajax',
              success: function(result){
                  if(result == 'logout'){
                      window.location.href='../logout.php';
                  }
              }
            });
        }
<DOCTYPE htm>
<!DOCTYPE html>
<html>

    <body>
    

    <script>
    		window.fbAsyncInit = function() {
				FB.init({
					appId      : '2595947140691828',
					cookie     : true,
					xfbml      : true,
					version    : 'v4.0'
				});
				FB.AppEvents.logPageView();
			};

			(function(d, s, id){
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement(s); js.id = id;
				js.src = "https://connect.facebook.net/es_LA/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
            FB.getLoginStatus(
			
            
            function(response) {
					statusChangeCallback(response);
				}
			);
			
			function checkLoginState() {
				FB.getLoginStatus(
					function(response) {
						statusChangeCallback(response);
					}
				);
			}
			
			
	
    </script>
        <h1>This is a Heading</h1>
		<p>This is a paragraph.</p>
        
		<fb:login-button
        scope="public_profile,email"
        >
        </fb:login-button>

		<fb:login-button
		size="small"
        scope="public_profile,email"
        onlogin="ObtenerEstadoInicioSesion();">
        </fb:login-button>
		<fb:login-button
		size="large"
        scope="public_profile,email"
        onlogin="ObtenerEstadoInicioSesion();">
        </fb:login-button>
		<br/> <br/>
		<fb:share-button
        layout="icon_link"
		size="small"
		>
        </fb:share-button>

		<fb:share-button
        layout="box_count"
		size="large"
		>
        </fb:share-button>

		<fb:share-button
        layout="button_count"
		>
        </fb:share-button>
		<fb:share-button
        layout="button"
		href="https://developers.facebook.com/"
		>
        </fb:share-button>


    </body>
</html>
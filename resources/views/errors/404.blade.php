<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />
    <!--// Main Content \\-->
		<div class="wm-main-content ">

            <!--// Main Section \\-->
            <div class="wm-main-section">
            	<div class="wm-404page-bg">
                	<div class="container">
	                    <div class="row">
							<div class="col-md-7">
								<div class="wm-404page">
									<div class="wm-404page-text">
										<h3>Ooops! Page Not Found!</h3>
										<p>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable..</p>
										<ul>
											<li>If you typed the page adress, make sure it is spelled correctly.</li>
											<li>Click <a href="#">Back</a> button to try another link.</li>
											<li>Or go back on <a href="{{ route('home') }}">Homepage</a> and try there.</li>
										</ul>
										<form>
											<input type="text" id="autocomplete" onfocus="if(this.value =='Enter Your Keyword') { this.value = ''; }" onblur="if(this.value == '') { this.value ='Enter Your Keyword'; }" value="Enter Your Keyword">
											<i class="fas fa-search"></i>
											<input type="submit" value="">
										</form>
									</div>
									<div class="wm-404page-button">
										<ul>
											<li><a href="#"><span>Go Back</span></a></li>
											<li><a href="#"><span>back To homepage</span></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
            <!--// Main Section \\-->

		</div>
		<!--// Main Content \\-->
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $('#autocomplete').autocomplete({
              source:'{!!URL::route('autocomplete')!!}',
                minlength:1,
                autoFocus:true,
                select:function(e,ui)
                {
                    $('#searchname').val(ui.item.value);
                }
            });
      </script>

<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Gamedaypicksllc</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="{{asset('landing_pages/assets/css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('landing_pages/assets/css/style.css')}}" rel="stylesheet">
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-KFQ62F0F5W"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
         gtag('config', 'G-KFQ62F0F5W');
         </script>

   </head>
   <body>
      <section id="campaign-section" class="gamedaypicksLlc full-section" style="background-image:url({{asset('landing_pages/assets/images/landing_0001.jpg')}})">
         <div class="container position-relative">
            <div class="row align-items-center">   
               <div class="col-md-12"> 
                  <div class="vfluidPlan"> <img src="{{asset('landing_pages/assets/images/img_0001.png')}}" class="img-fluid" alt=""> </div>
               </div>
            </div>
            <div class="row align-items-center">
               <div class="col-md-3">
                  <div class="voteBlockimg"><img src="{{asset('landing_pages/assets/images/make-your-landing-count.png')}}" alt=""></div>
                  
               </div>
               <div class="col-md-6">
                  <div class="gvsfCampaignImgBlock">
                     <a href="https://www.google.com/" target="_blank" class="googleGameday"> <img src="{{asset('landing_pages/assets/images/Google-vs-gameday.png')}}" class="img-fluid" alt=""></a>
                      <img src="{{asset('landing_pages/assets/images/vs-gameday.png')}}" class="img-fluid img-vs-gameday" alt="">
                     <a href="https://www.facebook.com/profile.php?id=100093917258630"  target="_blank" class="img-FacebookGameday"> <img src="{{asset('landing_pages/assets/images/vs-Facebook-gameday.png')}}" class="img-fluid" alt=""> </a>
                   </div>

                  <div class="campaignBlock front-img-campaign">
                     <div class="campaignBlockimg">
<div class="campaignBlockimgIntro">
                        {{-- <img src="{{asset('landing_pages/assets/images/Google-vs-Facebook-gameday.png')}}" class="img-fluid imgGoogleVSfacebook" alt=""> --}}
                        <div class="gamedaypicksLlcimg"><img src="{{asset('landing_pages/assets/images/gameday-picks-llc-jersey-letters.png')}}" class="img-fluid" alt=""></div>
                     </div>
                     </div>
                     

                  </div>
               </div>
               <div class="col-md-3">
                  <div class="totalvote">       
                     <span class="totalVoteTitle">Total lands</span>
                     <span class="totalVoteNo" id="totalVoteNum">338483</span> 
                  </div>

                  


                  
               </div>
            </div>
         </div>
         <div class="container position-relative">
            <div class="campaignBlock">
				 <div class="voteBlockimg">
					<div class="campaignBlockcontent">
					   <h4 class="HeadingText">Score card</h4>
					   <div class="campaignBlockWrap">
                     <div class="google-row">
                        <div class="countdownBlock" id="gVoteNum">188,978	</div>
                      </div>
						  <div class="campaignVsText">							 
						  </div>
						  <div class="facebook-row">
                     <span id="fsuccess"></span>
                     <div class="countdownBlock" id="fVoteNum">149,505	</div>
                   </div>
					   </div>
					</div>
				 </div>
				 <div class="button-link text-center mt-2 mb-2">
				    <a href="{{route('home')}}" class="btn btn-outline-primary">ADVANCE</a>
				 </div>
			  </div>
         </div>
      </section>
      <footer>
         <div id="socialMedia">
            <div class="container">
               <div class="row">
                  <div class="col">
                     <div id="social_media_sharing_buttons">
                        @if (!empty($social_links))
                        @if ($social_links['Facebook'] != '')
					         <a href="{{ $social_links['Facebook'] }}" target="_blank" class="fa fa-facebook"></a>
                        @endif
                        @if ($social_links['Twitter'] != '')
                        <a href="{{ $social_links['Twitter'] }}" target="_blank" class="fa fa-twitter"></a>
                        @endif
                        @if ($social_links['Instagram'] != '')
						      <a href="{{ $social_links['Instagram'] }}" target="_blank" class="fa fa-instagram"></a>
                        @endif
                        @if ($social_links['Linkedin'] != '')
                        <a href="{{ $social_links['Linkedin'] }}" target="_blank" class="fa fa-linkedin"></a>
                        @endif
                        @if ($social_links['Youtube'] != '')
                        <a href="{{ $social_links['Youtube'] }}" target="_blank" class="fa fa-youtube-play"></a>
                        @endif
                        @if ($social_links['Pinterest'] != '')
                        <a href="{{ $social_links['Pinterest'] }}" target="_blank" class="fa fa-pinterest"></a>
                        
                        @endif
                     @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="copyright">
            <div class="container">
               <div class="row">
                  <div class="col">© Copyright 2023 <a href="{{route('home')}}">gamedaypicksllc.com</a>. All Rights Reserved</div>
               </div>
            </div>
         </div>
      </footer>
	  
	  
		   
		   
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	  
	  
   </body>
</html>
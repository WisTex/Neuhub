{{if $connect}}
      <nav class="nav nav-pills p-4 mb-4  bg-white">
          <p>Connect to the <b>{{$name}}</b> channel to receive updates and to interact on this channel.</p>
          <!--
         <a class="nav-link active bg-secondary" 
            aria-current="true" 
            href="{{$link}}">{{$name}}
         </a>
         -->
         <!--
         <a class="nav-link text-primary" 
            href="#">About Us
         </a>
         <a class="nav-link text-primary" 
            href="#">Careers
         </a>
         <a class="nav-link text-primary" 
            href="#">Contact Us
         </a>
         -->
         
         <a class="nav-link active text-white ms-auto" rel="nofollow" {{if !$localuser}}target="_blank"{{/if}}
            href="follow?f=&url={{$follow}}&interactive=1">{{$connect}}{{if !$localuser}} <i class="fa fa-external-link"></i>{{/if}}
         </a>
         
      </nav>
{{/if}}

	  
    <div class="card" mb-5>
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item"><a class="nav-link active" href="/rmagic">Magic Sign On</a></li>
                <li class="nav-item"><a class="nav-link" href="/login">Local Login</a></li>
                <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
            </ul>
        </div>
        <div class="card-body">

            <h2>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-affiliate-filled" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M18.5 3a2.5 2.5 0 1 1 -.912 4.828l-4.556 4.555a5.475 5.475 0 0 1 .936 3.714l2.624 .787a2.5 2.5 0 1 1 -.575 1.916l-2.623 -.788a5.5 5.5 0 0 1 -10.39 -2.29l-.004 -.222l.004 -.221a5.5 5.5 0 0 1 2.984 -4.673l-.788 -2.624a2.498 2.498 0 0 1 -2.194 -2.304l-.006 -.178l.005 -.164a2.5 2.5 0 1 1 4.111 2.071l.787 2.625a5.475 5.475 0 0 1 3.714 .936l4.555 -4.556a2.487 2.487 0 0 1 -.167 -.748l-.005 -.164l.005 -.164a2.5 2.5 0 0 1 2.495 -2.336z" stroke-width="0" fill="currentColor" />
                </svg>
                {{$title}}
            </h2>

            <p>Use your existing Magic Sign On or Hubzilla social identity to interact with this website.</p>

            <div class="generic-content-wrapper-styled">
	
	            <form action="rmagic" method="post" >
		            <div class="mb-3">
    			        {{include file="field_input.tpl" field=$address}}
	    		        <input class="btn btn-primary" type="submit" name="submit" id="rmagic-submit-button" value="{{$submit}}" />
		            </div>
	            </form>
            </div>

            <p>If you created an account on this website, please enter your username and password on the <a href="/login">local login</a> page instead.

        </div>
    </div>

<!--
    <div class="card mt-5">
        <div class="card-body">
            <h3 style="text-align: left;">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-affiliate-filled" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M18.5 3a2.5 2.5 0 1 1 -.912 4.828l-4.556 4.555a5.475 5.475 0 0 1 .936 3.714l2.624 .787a2.5 2.5 0 1 1 -.575 1.916l-2.623 -.788a5.5 5.5 0 0 1 -10.39 -2.29l-.004 -.222l.004 -.221a5.5 5.5 0 0 1 2.984 -4.673l-.788 -2.624a2.498 2.498 0 0 1 -2.194 -2.304l-.006 -.178l.005 -.164a2.5 2.5 0 1 1 4.111 2.071l.787 2.625a5.475 5.475 0 0 1 3.714 .936l4.555 -4.556a2.487 2.487 0 0 1 -.167 -.748l-.005 -.164l.005 -.164a2.5 2.5 0 0 1 2.495 -2.336z" stroke-width="0" fill="currentColor" />
                </svg>
                Magic Sign On
            </h3>
        
            <p class="card-text" style="text-align: left;margin-top: 16px;">This website is part of a decentralized social network, with remote authentication powered by <a href="https://magicsignon.org" target="_blank">OpenWebAuth&nbsp;<i class="fa fa-external-link"></i></a>.</p>
            <p style="text-align: left;">If you already have an account on a website that supports OpenWebAuth, you do not need to create a local account here. You can remotely authenticate with your existing social identity.</p>
            <p>Magic Sign On is also known as Magic Auth, Remote Magic, RMagic, or Remote Authentication.</p>
        </div>
    </div>
-->

    <div class="card mt-5">
        <div class="card-body">
            <h3 style="text-align: left;">How to Remotely Authenticate</h3>

            <p>Using remote authentication is easy. In many cases, it is automatic.</p>

            <ol>
            <li>Log into your home hub or instance on this device (and stay logged in).</li>
            <li>Enter your channel address above and press the "authenticate" button.</li>
            </ol>

            <p>This website will check and see if you are logged into your home hub or instance on this device, and if you are, it will remotely authenticate you.</p>

            <p>If you try to authenticate and it returns you back to this page, you are either not logged into your home hub, or you typed your channel name incorrectly.</p>  

            <!--
            <p style="text-align: left;">To remotely authenticate with your existing social identity, you must be logged into your home hub or instance, and then enter your channel address on this website (channel@example.com). This website will check and see if you are logged into your home hub or instance, and if you are, it will remotely authenticate you.</p>
            <p>Note: You must be logged into your home hub or instance on the same device.</p>
            -->
        </div>
    </div>

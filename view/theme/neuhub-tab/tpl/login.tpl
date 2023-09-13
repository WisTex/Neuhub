    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item"><a class="nav-link" href="/rmagic">Magic Sign On</a></li>
                <li class="nav-item"><a class="nav-link active" href="/login">Local Login</a></li>
                <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
            </ul>
        </div>
        <div class="card-body">

            <h2>Login</h2>

            <form action="{{$dest_url}}" id="{{$form_id}}" method="post" >
                <input type="hidden" name="auth-params" value="login" />
                <div class="login-wrapper d-grid gap-2">
                    {{include file="field_input.tpl" field=$lname}}
                    {{include file="field_password.tpl" field=$lpassword}}
                    <span class="text-black">{{include file="field_checkbox.tpl" field=$remember_me}}</span>
                    <button type="submit" name="submit" class="btn btn-primary">{{$login}}</button>
                    {{if $register}}<a href="{{$register.link}}" title="{{$register.title}}" class="register-link float-end">{{$register.desc}}</a>{{/if}}
                    {{if $lostlink}}<a href="lostpass" title="{{$lostpass}}" class="lost-pass-link">{{$lostlink}}</a>{{/if}}
                    <hr>
                    <a href="rmagic" class="btn btn-outline-purple">Sign On with Magic Sign On</a>
                    
                    <a href="rmagic" class="btn btn-outline-azure">Sign On with Hubzilla</a>
                    
                    <a href="rmagic" class="btn btn-outline-success">{{$remote_login}}</a>
                </div>
                {{foreach $hiddens as $k=>$v}}
                    <input type="hidden" name="{{$k}}" value="{{$v}}" />
                {{/foreach}}
            </form>
            {{if $login_page}}
            <script type="text/javascript"> $(document).ready(function() { $("#id_{{$lname.0}}").focus();} );</script>
            {{/if}}

        </div>
    </div>
  
    <!--
    <div class="card mt-5">
        <div class="card-body">
            <h3 style="">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-affiliate-filled" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M18.5 3a2.5 2.5 0 1 1 -.912 4.828l-4.556 4.555a5.475 5.475 0 0 1 .936 3.714l2.624 .787a2.5 2.5 0 1 1 -.575 1.916l-2.623 -.788a5.5 5.5 0 0 1 -10.39 -2.29l-.004 -.222l.004 -.221a5.5 5.5 0 0 1 2.984 -4.673l-.788 -2.624a2.498 2.498 0 0 1 -2.194 -2.304l-.006 -.178l.005 -.164a2.5 2.5 0 1 1 4.111 2.071l.787 2.625a5.475 5.475 0 0 1 3.714 .936l4.555 -4.556a2.487 2.487 0 0 1 -.167 -.748l-.005 -.164l.005 -.164a2.5 2.5 0 0 1 2.495 -2.336z" stroke-width="0" fill="currentColor" />
                </svg>
                Magic Sign On
            </h3>
            <p class="card-text" style="margin-top: 16px;">This website is part of a decentralized social network, with remote authentication powered by <a href="https://magicsignon.org" target="_blank">OpenWebAuth&nbsp;<i class="fa fa-external-link"></i></a>.</p>
            <p style="">If you already have an account on a website that supports OpenWebAuth, you do not need to create a local account here. You can <a href="/rmagic">remotely authenticate</a> with your existing social identity.</p>
            {{* <!-- <p>Magic Sign On is also known as Magic Auth, Remote Magic, RMagic, or Remote Authentication.</p> --> *}}
        </div>
        <div class="card-body">
            <p><small>Magic Sign On is also known as Magic Auth, Remote Magic, RMagic, or Remote Authentication.</small></p>
        </div>
    </div>
    -->
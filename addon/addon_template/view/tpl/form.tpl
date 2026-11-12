{{* Hubzilla's template renderer replaces {{$variables}} supplied by the module.
    Copyright (c) 2026 WisTex TechSero Ltd. Co. — MIT Expat License. *}}
<div class="generic-content-wrapper">
  <div class="section-title-wrapper"><h2>{{$title}}</h2></div>
  <div class="section-content-wrapper">
    <p>{{$description}}</p>
    <form method="post" action="{{$action_url}}">
      {{* The name must match check_form_security_token()'s default formname. *}}
      <input type="hidden" name="form_security_token" value="{{$token}}">
      <label for="example_message">{{$field_label}}</label>
      <input id="example_message" name="example_message" type="text" maxlength="120" value="{{$value}}">
      <button type="submit">{{$submit_label}}</button>
    </form>
    <p><a href="{{$home_url}}">{{$home_label}}</a></p>
  </div>
</div>

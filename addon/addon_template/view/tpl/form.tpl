{{* Practical greeting preference: view saved data and edit it on one page.
    Hubzilla replaces {{$variables}} with values supplied by the Controller.
    Copyright (c) 2026 WisTex TechSero Ltd. Co. — MIT Expat License. *}}
<div class="generic-content-wrapper">
  <div class="section-title-wrapper"><h2>{{$title}}</h2></div>
  <div class="section-content-wrapper">
    <p>{{$description}}</p>

    {{* {{if}} and {{else}} are Hubzilla template conditionals.
        The Controller supplies $has_greeting and HTML-escaped text. *}}
    <section class="mb-4" aria-label="{{$preview_label}}">
      <h3>{{$preview_label}}</h3>
      {{if $has_greeting}}
        <p class="lead">{{$display_greeting}}</p>
      {{else}}
        <p class="text-muted">{{$empty_label}}</p>
      {{/if}}
    </section>

    <form method="post" action="{{$action_url}}">
      {{* Hubzilla's CSRF checker expects this exact field name by default. *}}
      <input type="hidden" name="form_security_token" value="{{$token}}">
      <div class="mb-3">
        <label class="form-label" for="example_message">{{$field_label}}</label>
        <input class="form-control" id="example_message" name="example_message"
               type="text" maxlength="120" value="{{$value}}"
               aria-describedby="greeting-help">
        <div class="form-text" id="greeting-help">{{$field_help}}</div>
      </div>
      <button class="btn btn-primary" type="submit">{{$submit_label}}</button>
    </form>
    <p class="mt-3"><a href="{{$home_url}}">{{$home_label}}</a></p>
  </div>
</div>

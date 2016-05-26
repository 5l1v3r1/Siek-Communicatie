{# Template inheritance #}
{% extends "templates/main.volt" %}

{# Content #}
{% block layout %}
    <section class="vertical-wrap" id="login">
        <div class="container vertical">

            {# Paradoxis logo #}
            <div class="row">
                <div class="col-md-2 col-md-offset-5">
                    <img src="//paradoxis.nl/share/assets/images/paradoxis/logo/svg/icon_blue.svg" alt="Paradoxis logo" />
                </div>
            </div>

            {# Paradoxis title #}
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <img src="//paradoxis.nl/share/assets/images/paradoxis/logo/svg/text_gray.svg" alt="Paradoxis" />
                </div>
            </div>

            {# Login form #}
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <form action="/admin" method="post">
                        {% if messages is defined and messages %}
                            <div class="alert alert-danger">
                                {% for message in messages %}
                                    {{ message|e }}
                                {% endfor %}
                            </div>
                        {% endif %}

                        <div class="form-group">
                            {{ text_field('username', 'class' : 'form-control', 'placeholder' : 'Username', 'required' : 'required') }}
                        </div>

                        <div class="form-group">
                            {{ password_field('password', 'class' : 'form-control', 'placeholder' : 'Password', 'required' : 'required') }}
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block " name="login" value="login">
                                <i class="fa fa-sign-in"></i> Login
                            </button>
                            {{ hidden_field(security.getTokenKey(), 'value' : security.getToken()) }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
{% endblock %}

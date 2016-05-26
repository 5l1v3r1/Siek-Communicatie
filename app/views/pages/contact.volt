{% extends "templates/main.volt" %}

{# Layout #}
{% block layout %}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-5 col-sm-push-7">
                    <div class="face" style="background-image: url('/assets/images/team/md/team.jpg')"></div>
                </div>

                <div class="col-xs-12 col-sm-7 col-sm-pull-5">
                    <h1>Contact</h1>

                    <table class="table">
                        {% for title, link in links %}
                            {% if title == 'envelope'  %}
                                {% set url = "mailto:" ~ link %}
                            {% elseif title == 'phone' %}
                                {% set url = "tel:"    ~ link %}
                            {% else %}
                                {% set url = "http://" ~ link %}
                            {% endif %}

                            {% if link is empty == false %}
                                <tr>
                                    <td>
                                        <a href="{{ url|e }}">
                                            <i class="fa fa-{{ title|e }}-square fa-2x"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url|e }}">{{ link|e }}</a>
                                    </td>
                                </tr>
                            {% endif %}
                        {% endfor %}
                    </table>

                    <p>
                        Voor een afspraak, vragen over de organisatie of aanvullende informatie kunt u via onderstaand formulier contact opnemen.
                        SIEK neemt dan zo spoedig mogelijk contact met u op.
                    </p>

                    <form method="post" action="/contact">

                        {# Message #}
                        {% if form_sent %}
                                <div class="form-group">
                                    {% if form_success %}
                                        <div class="alert alert-success">{{ form_message|e }}</div>
                                    {% else %}
                                        <div class="alert alert-danger">{{ form_message|e }}</div>
                                    {% endif %}
                                </div>
                        {% endif %}


                        {# Contact details and message #}
                        <div class="form-group">
                            <label for="email">Email addres</label>
                            {% if form_sent and form_success %}
                                {{ email_field('email', 'class' : 'form-control', 'placeholder' : 'Email addres', 'required' : 'required', 'value' : '') }}
                            {% else %}
                                {{ email_field('email', 'class' : 'form-control', 'placeholder' : 'Email addres', 'required' : 'required') }}
                            {% endif %}
                        </div>

                        <div class="form-group">
                            <label for="subject">Onderwerp</label>
                            {% if form_sent and form_success %}
                                {{ text_field('subject', 'class' : 'form-control', 'placeholder' : 'Onderwerp', 'required' : 'required', 'value' : '') }}
                            {% else %}
                                {{ text_field('subject', 'class' : 'form-control', 'placeholder' : 'Onderwerp', 'required' : 'required') }}
                            {% endif %}
                        </div>

                        <div class="form-group">
                            <label for="message">Bericht</label>
                            {% if form_sent and form_success %}
                                {{ text_area('message', 'class' : 'form-control', 'placeholder' : 'Bericht..', 'required' : 'required', 'value' : '') }}
                            {% else %}
                                {{ text_area('message', 'class' : 'form-control', 'placeholder' : 'Bericht..', 'required' : 'required') }}
                            {% endif %}
                        </div>


                        {# Anti spam questions #}
                        <div class="col-xs-12">
                            <label for="spam-question">Wat is de derde letter in de naam "SIEK"?</label>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                {% if form_sent and form_success %}
                                    {{ text_field('spam-question', 'class' : 'form-control', 'placeholder' : 'Brein brekend antwoord', 'required' : 'required', 'value' : '') }}
                                {% else %}
                                    {{ text_field('spam-question', 'class' : 'form-control', 'placeholder' : 'Brein brekend antwoord', 'required' : 'required') }}
                                {% endif %}
                            </div>
                        </div>


                        {# Submit button #}
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-default btn-block" name="contact" value="other">Stuur</button>
                            </div>
                        </div>


                        {# XSRF & anti-spam #}
                        <div class="hidden">
                            <label for="anti-spam">Vul het onderstaande veld NIET in.</label>
                            <input type="number" name="anti-spam" id="anti-spam" value="">
                            <input type="hidden" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
{% endblock %}

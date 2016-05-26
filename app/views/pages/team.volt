{% extends "templates/main.volt" %}

{# Layout #}
{% block layout %}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-5 col-sm-push-7">
                    <div class="face" style="background-image: url('/assets/images/team/md/{{ member.url|e }}.jpg')"></div>
                </div>

                <div class="col-xs-12 col-sm-7 col-sm-pull-5">
                    <h1>{{ member.name|e }}</h1>
                    <h3>{{ member.title|e }}</h3>
                    <article>{{ member.text|e|nl2br|style }}</article>
                </div>
            </div>
        </div>
    </section>
{% endblock %}

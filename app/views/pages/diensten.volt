{% extends "templates/main.volt" %}
{% block layout %}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>Diensten</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-9">
                    <p>{{ text_main|e|nl2br|style }}</p>
                </div>
            </div>
        </div>
    </section>
{% endblock %}
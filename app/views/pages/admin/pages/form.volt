{# Template inheritance #}
{% extends "templates/admin.volt" %}

{# Content #}
{% block layout %}
    <h1>Admin - Edit page {{ page|lower|e }} - {{ section|lower|e }}</h1>

    <div class="row">
        <div class="col-sm-6">
            <form action="/admin/pages/edit/{{ page|lower|e }}/{{ section|lower|e }}" method="post">

                {# Form message #}
                {% if form_sent %}
                    <div class="form-group">
                        {% if form_success %}
                            <div class="alert alert-success">{{ form_message|e }}</div>
                        {% else %}
                            <div class="alert alert-danger">{{ form_message|e }}</div>
                        {% endif %}
                    </div>
                {% endif %}

                {# Form editor #}
                {% if content is defined %}
                    {{ partial("partials/editor-new") }}
                {% else %}
                    {{ partial("partials/editor-new") }}
                {% endif %}

                {# CSRF tokens #}
                {{ hidden_field(security.getTokenKey(), 'value':security.getToken()) }}
            </form>
        </div>

        {# Preview text #}
        {# Don't add anything in the article. #}
        <div class="col-sm-6" id="preview">
            <h1></h1>
            <article></article>
        </div>
    </div>
{% endblock %}
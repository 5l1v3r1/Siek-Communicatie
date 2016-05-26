{# Template inheritance #}
{% extends "templates/admin.volt" %}

{# Content #}
{% block layout %}
    <h1>Admin - {{ action|capitalize|e }} blog post</h1>

    <div class="row">
        <div class="col-sm-6">
            <form action="/admin/blog/{{ form_action|e }}" method="post">

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
                {% if post is defined %}
                    {{ partial("partials/editor", ['date': date('Y-m-d', strtotime(post.date)), 'title': post.title, 'text' : post.text]) }}
                {% else %}
                    {{ partial("partials/editor") }}
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
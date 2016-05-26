{# Load the template #}
{% extends "templates/blog.volt" %}

{# Title #}
{% block title %}
    {% if post %}
        {{ post.title|e }}
        <small>{{ post.author|e }} - {{ date('d-m-Y', strtotime(post.date))|e }}</small>
    {% else %}
        404 - Not Found
        <small>Blog article not found</small>
    {% endif %}
{% endblock %}

{# Content #}
{% block content %}
    <div class="row">
        <div class="col-xs-12">
            {% if post %}
                <article>{{ post.text|e|nl2br|style }}</article>
            {% else %}
                <article>This blog article does not exist, or has been removed.</article>
            {% endif %}
        </div>
    </div>
{% endblock %}
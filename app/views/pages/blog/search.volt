{# Load the template #}
{% extends "templates/blog.volt" %}

{# Title #}
{% block title %}
    Zoek resultaten
    <small>Uw zoekopdracht leverde {{ posts_count }} zoekresultaten op.</small>
{% endblock %}

{# Content #}
{% block content %}
    {{ partial('partials/blog/posts') }}
{% endblock %}

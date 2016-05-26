{# Load the template #}
{% extends "templates/blog.volt" %}

{# Title #}
{% block title %}Blog{% endblock %}

{# Content #}
{% block content %}
    {{ partial('partials/blog/posts') }}
{% endblock %}
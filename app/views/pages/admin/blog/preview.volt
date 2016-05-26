{% if text == "" %}
    This blog article does not exist, or has been removed.
{% else %}
    {{ text|e|nl2br|style }}
{% endif %}

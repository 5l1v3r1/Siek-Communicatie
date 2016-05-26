<html lang="en">
    <head >
    </head>
    <body>
        {# Email header #}
        {{ partial('partials/email/mail_header') }}

        {# Email content #}
        <div style="padding: 5px 30px;">
            {% if title is defined %}
                <h1 style="margin-bottom: 5px;">{{ title }}</h1>
            {% endif %}
            {{ content() }}
        </div>

        {# Email footer #}
        {{ partial('partials/email/mail_footer') }}
    </body>
</html>
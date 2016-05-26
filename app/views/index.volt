{{ partial('partials/misc_credits') }}
<!DOCTYPE html>
<html lang="en">
    <head>
        {# Meta tags #}
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml" />
        {% if noFollow is defined and noIndex is defined %}
            {% if noFollow and noIndex %}
                <meta name="robots" content="noindex, nofollow" />
            {% elseif noFollow and noIndex == false %}
                <meta name="robots" content="index, nofollow" />
            {% elseif noFollow == false and noIndex %}
                <meta name="robots" content="noindex, follow" />
            {% endif %}
        {% else %}
            <meta name="description" content="{{ seo.description|e }}">
            <meta name="keywords" content="{{ seo.keywords|e }}">
            <meta name="revisit-after" content="14 days">
            <meta name="robots" content="index, follow">
        {% endif %}

        {# CSS tags #}
        {{ partial('partials/tags_style') }}
        {{ assets.outputCss() }}

        {# Title  (dynamic), eg {sitename} * {title} #}
        {% if title is defined and title != '' %}
            <title>Siek &middot; {{ title|e }}</title>
        {% else %}
            <title>Siek</title>
        {% endif %}
    </head>
    <body>
        {# Content #}
        {{ content() }}

        {# JavaScript tags #}
        {{ partial('partials/tags_scripts') }}
        {{ assets.outputJs() }}
    </body>
</html>

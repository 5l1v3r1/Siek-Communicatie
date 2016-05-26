{# Header #}
<header>
    <div class="hero"  data-stellar-ratio="0.5"></div>
    {{ partial('partials/nav') }}
</header>

{# Main body #}
<main>
    <section>
        <div class="container">

            {# Title #}
            <div class="row" id="header">
                <div class="col-xs-12">
                    <h1>{% block title %}{% endblock %}</h1>
                    <div class="navigation">
                        <ul>
                            <li><a href="/blog" title="Blog home">Blog home</a></li>

                            {% for item in navigation %}
                                {% if item.title != '' %}
                                    <li><a href="{{ item.url|e }}" title="{{ item.title|e }}">{{ item.title|e }}</a></li>
                                {% endif %}
                            {% endfor %}
                        </ul>
                    </div>
                </div>
            </div>


            {# Content #}
            {# Posts & navigation#}
            <div class="row">

                {# Posts (and their links #}
                <div class="col-sm-8" id="posts">
                    {% block content %}{% endblock %}
                    <div class="navigation">
                        <ul>
                            {% for item in navigation %}
                                <li><a href="{{ item.url|e }}" title="{{ item.title|e }}">{{ item.title|e }}</a></li>
                            {% endfor %}
                        </ul>
                    </div>
                </div>

                {# Navigation #}
                <div class="col-sm-4" id="nav">
                    {{ partial('partials/blog/navigation') }}
                </div>
            </div>
        </div>
    </section>
</main>

{# Footer #}
{{ partial('partials/footer') }}
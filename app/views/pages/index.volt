{# Navigation #}
{{ partial('partials/nav') }}


{# Header #}
<header class="vertical-wrap">

    {# Content #}
    <div class="hero" data-stellar-ratio="0.5"></div>
    <div class="vertical">

        {# Title #}
        <h1>SIEK communicatie</h1>
        <h2>Succes is een keuze</h2>
        <noscript>
            <div>
                Schakel voor het beste resultaat JavaScript in, <a href="http://www.enable-javascript.com/nl/">hier</a> vindt u huit hoe.
            </div>
            <link rel="stylesheet" href="/assets/css/noscript.css" />
        </noscript>

        {# Youtube player #}
        <a href="https://www.youtube.com/watch?v=B8dEAhypNGA" target="_self" class="litebox arrow">
            <i class="fa fa-play"></i>
        </a>
        <a href="#what" class="arrow hidden">
            <i class="fa fa-play"></i>
        </a>

        {# Arrow pointing down #}
        <a id="arrow" href="#what">
            <i class="fa fa-long-arrow-down"></i>
        </a>
    </div>
</header>

{# Main content #}
<main>

    {# what #}
    <section id="what">
        <div class="container">

            {# Title #}
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 text-center">
                    <h2>Wat is SIEK</h2>
                </div>
            </div>

            {# Text #}
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <article>{{ text_what|e|nl2br|style }}</article>
                </div>
            </div>

        </div>
    </section>


    {# Team #}
    <section id="team">
        <div class="container text-center">

            {# Title #}
            <div class="row">
                <div class="col-xs-8 col-xs-offset-2 text-center">
                    <h2>Meet the team</h2>
                </div>
            </div>

            {# Every group member #}
            <div class="row row-centered">
                {% for member in team %}
                    <div class="col-xs-12 col-sm-4 col-centered face">
                        <a href="/team/{{ member.url|e }}">
                            <div style="background-image: url('/assets/images/team/sm/{{ member.url|e|url_encode }}.jpg')"></div>
                        </a>
                        <h3>{{ member.name|e }}</h3>
                        <h4>{{ member.title|e }}</h4>
                    </div>
                {% endfor %}
            </div>
        </div>
    </section>


    {# References #}
    <section id="references">
        <div class="container-fluid">

            {# Quotes #}
            <div class="row">

                {% for i, reference in references %}
                <div class="col-xs-12 col-sm-6">
                    <blockquote>
                        <p>&ldquo;{{ reference.quote|e }}&rdquo;</p>
                        {% if reference.source or reference.date %}
                            <footer>{{  reference.author|e }} &middot; <cite title="{{ reference.source|e }}">{{ reference.source|e }} {{ reference.date|e }}</cite></footer>
                        {% else %}
                            <footer>{{  reference.author|e }}</footer>
                        {% endif %}
                    </blockquote>
                </div>

                {# Add row breaks to fix the formatting issue #}
                {% if (i + 1) % 2 == 0 and loop.last == false %}
            </div>
            <div class="row">
                {% endif %}
                {% endfor %}

            </div>
        </div>
    </section>


    {# About #}
    <section id="about">
        <div class="container">

            {# Title #}
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 text-center">
                    <h2>Over SIEK</h2>
                </div>
            </div>

            {# Text #}
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <article>{{ text_about|e|nl2br|style }}</article>
                </div>
            </div>

        </div>
    </section>
</main>


{# Footer #}
{{ partial('partials/footer') }}

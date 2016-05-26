{# Header #}
<header>
    <div class="hero"  data-stellar-ratio="0.5"></div>
    {{ partial('partials/nav') }}
</header>

{# Main body #}
<main>

    {# Layout #}
    {% block layout %}
        <section></section>
    {% endblock %}
</main>

{# Footer #}
{{ partial('partials/footer') }}
{# Header #}
<header>
    <div class="hero"  data-stellar-ratio="0.5"></div>
    {{ partial('partials/nav') }}
</header>

{# Main body #}
<main>
    <div class="container-fluid">

        {# Navigation #}
        <div class="col-sm-2">
            {{ partial("partials/admin/navigation") }}
        </div>

        {# Content #}
        <div class="col-sm-10">
            <section>
                {% block layout %}{% endblock %}
            </section>
        </div>
    </div>
</main>

{# Footer #}
{{ partial('partials/footer') }}
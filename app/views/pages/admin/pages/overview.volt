{# Template inheritance #}
{% extends "templates/admin.volt" %}

{# Content #}
{% block layout %}
    <h1>Admin - {{ page|capitalize|e }} overview</h1>

    {# Data table #}
    <table class="table table-bordered table-hover">
        <tr>
            <th>ID</th>
            <th>Pagina</th>
            <th>Sectie</th>
            <th>Datum aangepast</th>
            <th>Acties</th>
        </tr>
        {% for item in list %}
            <tr>
                <td>{{ item.id }}</td>
                <td>{{ item.page|e|capitalize }}</td>
                <td>{{ item.section|e|capitalize }}</td>
                <td>{{ date("d-m-Y", strtotime(item.lastUpdated)) }}</td>
                <td><a href="/admin/pages/edit/{{ item.page|e|url_encode }}/{{ item.section|e|url_encode }}">Edit</a></td>
            </tr>
        {% else %}
            <tr>
                <td colspan="5">Geen blogberichten gevonden voor gebruiker {{ user.name|capitalize|e }}.</td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}
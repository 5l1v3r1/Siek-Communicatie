{# Template inheritance #}
{% extends "templates/admin.volt" %}

{# Content #}
{% block layout %}
    <h1>Admin - {{ page|capitalize|e }} overview</h1>

    {# Deleted message #}
    {% if postDeleted is defined and postDeleted %}
        <div class="alert alert-success">Blog bericht successvol verwijderd.</div>
    {% endif %}

    {# Data table #}
    <table class="table table-bordered table-hover">
        <tr>
            <th>ID</th>
            <th>Titel</th>
            <th>Datum</th>
            <th>Datum aangepast</th>
            <th colspan="2">Acties</th>
        </tr>
        {% for item in list %}
            <tr>
                <td>{{ item.id }}</td>
                <td>{{ item.title|e }}</td>
                <td>{{ date("d-m-Y", strtotime(item.date)) }}</td>
                <td>{{ date("d-m-Y", strtotime(item.lastUpdated)) }}</td>
                <td><a href="/admin/blog/edit/{{ item.id }}">Edit</a></td>
                <td><a href="/admin/blog/delete/{{ item.id }}">Delete</a></td>
            </tr>
        {% else %}
            <tr>
                <td colspan="5">Geen blogberichten gevonden voor gebruiker {{ user.name|capitalize|e }}.</td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}
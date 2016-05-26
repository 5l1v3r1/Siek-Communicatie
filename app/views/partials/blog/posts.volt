{% for post in posts %}
    <div class="row post">
        <div class="col-xs-12">
            <h2>{{ post.title|escape }}</h2>
            <p><b>Datum: </b>{{ post.date }}</p>
            <p><b>Auteur: </b>{{ post.author|escape }}</p>
            <article>{{ limit(post.text|escape|nl2br|style, 300) }}</article>
            <a href="/blog/post/{{ date('Y', strtotime(post.date)) }}/{{ date('m', strtotime(post.date)) }}/{{ date('d', strtotime(post.date)) }}/{{ post.url|escape }}">Lees meer..</a>
            {% if loop.last == false %}
                <hr />
            {% endif %}
        </div>
    </div>
{% else %}
    <div class="row">
        <div class="col-xs-12">
            {% if is_search is defined and is_search %}
                {% if search_query == "" %}
                    <p>Uw zoekopdracht moet minstens 1 karakter lang zijn.</p>
                {% else %}
                    <p>Geen zoekresultaten gevonden voor uw zoekopdracht "{{ search_query|e }}".</p>
                {% endif %}
            {% else %}
                <p>Geen blog artikelen gevonden</p>
            {% endif %}
        </div>
    </div>
{% endfor %}
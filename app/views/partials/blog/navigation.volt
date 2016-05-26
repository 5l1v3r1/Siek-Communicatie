<div class="row">
    <div class="col-xs-12">
        <h2>Zoek artikelen</h2>
    </div>

    <div class="col-xs-12">

        <form action="/blog/search" method="get">
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div class="form-group">
                        {{ text_field('title', 'class' : 'form-control', 'placeholder' : 'Zoek op titel') }}
                    </div>
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-default btn-block" value="Zoek">Zoek</button>
                    </div>
                </div>
            </div>
        </form>
        <hr/>
    </div>
</div>

<div class="row" id="recent">
    <div class="col-xs-12">
        <h2>Recente artikelen</h2>
    </div>

    {% for post in recent_posts %}
        <div class="col-xs-12">
            <a href="/blog/post/{{ date('Y', strtotime(post.date)) }}/{{ date('m', strtotime(post.date)) }}/{{ date('d', strtotime(post.date)) }}/{{ post.url|escape }}">{{ post.title|e }}</a>
        </div>
    {% else %}
        <div class="col-xs-12">
            <p>Geen blog artikelen gevonden</p>
        </div>
    {% endfor %}
</div>
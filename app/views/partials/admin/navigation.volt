<section>
    <ul>
        {# Admin home #}
        <li>
            <i class="fa fa-home"></i> <a href="/admin">Admin home</a>
        </li>

        {# Blog home #}
        <li>
            <i class="fa fa-newspaper-o"></i> <a href="/admin/blog">Blog</a>
            <ul>
                <li><i class="fa fa-plus-square-o"></i> <a href="/admin/blog/new">New</a></li>
            </ul>
        </li>

        {# The ability to edit pages #}
        {% if isAdmin %}
            <li>
                <i class="fa fa-list-alt"></i> <a href="/admin/pages">Pages</a>
            </li>
        {% endif %}

        {# Log out #}
        <li>
            <i class="fa fa-sign-out"></i> <a href="/admin/logout">Logout</a>
        </li>
    </ul>
</section>
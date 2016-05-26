{# Editor #}
<div class="row editor">
    <div class="col-sm-12 col-md-6 form-group">
        <a class="btn btn-default" data-action="bold"><i class="fa fa-bold"></i></a>
        <a class="btn btn-default" data-action="italic"><i class="fa fa-italic"></i></a>
        <a class="btn btn-default" data-action="underline"><i class="fa fa-underline"></i></a>
        <a class="btn btn-default" data-action="paragraph"><i class="fa fa-paragraph"></i></a>
        <a class="btn btn-default" data-action="list"><i class="fa fa-list"></i></a>
    </div>
    <div class="col-sm-12 col-md-6 form-group">
        {% if date is defined %}
            {{ date_field('date', 'class' : 'form-control', 'placeholder' : 'Message', 'autocomplete' : 'off', 'required' : 'required', 'value' : date) }}
        {% else %}
            {{ date_field('date', 'class' : 'form-control', 'placeholder' : 'Message', 'autocomplete' : 'off', 'required' : 'required', 'value' : date("Y-m-d")) }}
        {% endif %}
    </div>

    {# Title #}

    <div class="col-xs-12 form-group">
        {% if title is defined %}
            {{ text_field('title', 'class' : 'form-control', 'maxlength' : '64', 'placeholder' : 'Title', 'autocomplete' : 'off', 'required' : 'required', 'value' : title) }}
        {% else %}
            {{ text_field('title', 'class' : 'form-control', 'maxlength' : '64', 'placeholder' : 'Title', 'autocomplete' : 'off', 'required' : 'required') }}
        {% endif %}
    </div>

    {# Text field #}
    <div class="col-xs-12 form-group">
        {% if text is defined %}
            {{ text_area('message', 'class' : 'form-control', 'placeholder' : 'Message', 'autocomplete' : 'off', 'required' : 'required', 'value' : text) }}
        {% else %}
            {{ text_area('message', 'class' : 'form-control', 'placeholder' : 'Message', 'autocomplete' : 'off', 'required' : 'required') }}
        {% endif %}
    </div>

    {# Submit buttons #}
    <div class="col-xs-6 form-group">
        <button class="btn btn-block btn-success" type="submit">Submit</button>
    </div>
    <div class="col-xs-6 form-group">
        <a class="btn btn-block btn-danger" href="/admin/blog">Cancel</a>
    </div>
</div>
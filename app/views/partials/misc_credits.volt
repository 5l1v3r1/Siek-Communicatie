<!--
     ______   ______     ______     ______     _____     ______     __  __     __     ______
    /\  == \ /\  __ \   /\  == \   /\  __ \   /\  __-.  /\  __ \   /\_\_\_\   /\ \   /\  ___\
    \ \  _-/ \ \  __ \  \ \  __<   \ \  __ \  \ \ \/\ \ \ \ \/\ \  \/_/\_\/_  \ \ \  \ \___  \
     \ \_\    \ \_\ \_\  \ \_\ \_\  \ \_\ \_\  \ \____-  \ \_____\   /\_\/\_\  \ \_\  \/\_____\
      \/_/     \/_/\/_/   \/_/ /_/   \/_/\/_/   \/____/   \/_____/   \/_/\/_/   \/_/   \/_____/

    Copyright © 2014 - {{ date('Y') }} Paradoxis
    All rights reserved
{# God-awful formatting because it needs to be presented pretty in the source (sorry mom) #}
{% if credits is defined %}
{% for user in credits %}
    {{ user.name }} <{{ user.email }}> | {{ user.description }}

{% endfor %}

{% endif %}
-->
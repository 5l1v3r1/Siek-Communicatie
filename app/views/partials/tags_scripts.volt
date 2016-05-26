{# Basic script variables #}
<script>
    var IS_MOBILE   = {{ isMobile|json_encode  }};
    var IS_TABLET   = {{ isTablet|json_encode  }};
    var IS_CHROME   = {{ isChrome|json_encode  }};
    var IS_FIREFOX  = {{ isFirefox|json_encode }};
    var IS_SAFARI   = {{ isSafari|json_encode  }};
    var IS_OPERA    = {{ isOpera|json_encode   }};
    var IS_MSIE     = {{ isMSIE|json_encode    }};
</script>


{# jQuery plugins #}
<script type="text/javascript" src="/share/plugins/jquery/jquery.js"></script>
<script type="text/javascript" src="/share/plugins/jquery/jquery.easing.js"></script>
<script type="text/javascript" src="/share/plugins/jquery/jquery.transit.js"></script>
<script type="text/javascript" src="/share/plugins/jquery/jquery.waypoints.js"></script>
<script type="text/javascript" src="/share/plugins/jquery/jquery.stellar.js"></script>


{# Smooth scrolling for chrome #}
{% if isChrome %}
    <script type="text/javascript" src="/share/plugins/smoothscroll/smoothscroll.js"></script>
{% endif %}


{# IE compatability scripts #}
{% if isMSIE %}
    <!--[if lt IE 9]>
    <script type="text/javascript" src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script type="text/javascript" src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
{% endif %}

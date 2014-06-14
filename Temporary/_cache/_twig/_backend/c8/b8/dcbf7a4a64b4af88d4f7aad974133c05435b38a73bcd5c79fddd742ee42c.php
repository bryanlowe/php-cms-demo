<?php

/* _common/base.html */
class __TwigTemplate_c8b8dcbf7a4a64b4af88d4f7aad974133c05435b38a73bcd5c79fddd742ee42c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'header' => array($this, 'block_header'),
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE HTML>
<html lang=\"en\" xmlns=\"http://www.w3.org/1999/xhtml\">
  <head>
  \t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
      <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
      <link href=\"";
        // line 6
        echo (isset($context["IMAGEPATH"]) ? $context["IMAGEPATH"] : null);
        echo "/_common/favicon.ico\" rel=\"SHORTCUT ICON\">
      <title>";
        // line 7
        echo (isset($context["TITLE"]) ? $context["TITLE"] : null);
        echo "</title>
      ";
        // line 8
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["CSS"]) ? $context["CSS"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["css_import"]) {
            // line 9
            echo "      <link type=\"text/css\" href=\"";
            echo (isset($context["css_import"]) ? $context["css_import"] : null);
            echo "\" rel=\"stylesheet\" />
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['css_import'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "  </head> 
  <body>
  \t";
        // line 13
        $this->displayBlock('header', $context, $blocks);
        // line 60
        echo "        
    ";
        // line 61
        $this->displayBlock('content', $context, $blocks);
        // line 63
        echo "    
    ";
        // line 64
        $this->displayBlock('footer', $context, $blocks);
        // line 74
        echo "
    ";
        // line 75
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["JS"]) ? $context["JS"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["js_import"]) {
            // line 76
            echo "    <script type=\"text/javascript\" src=\"";
            echo (isset($context["js_import"]) ? $context["js_import"] : null);
            echo "\"></script>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['js_import'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 78
        echo "  </body>
</html>";
    }

    // line 13
    public function block_header($context, array $blocks = array())
    {
        // line 14
        echo "    <div id=\"wrapper\">
      <nav role=\"navigation\" class=\"navbar navbar-inverse navbar-fixed-top\">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class=\"navbar-header\">
          <a href=\"";
        // line 18
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/\" class=\"navbar-brand\">CEM Dashboard - Admin</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class=\"collapse navbar-collapse navbar-ex1-collapse\">
          <ul class=\"nav navbar-nav side-nav\">
            <li class=\"dropdown\">
              <a data-toggle=\"dropdown\" class=\"dropdown-toggle\" href=\"#\"><i class=\"fa fa-money\"></i> Client Control Panel <b class=\"caret\"></b></a>
              <ul class=\"dropdown-menu\">
                <li><a href=\"";
        // line 27
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/feedback\"><i class=\"fa fa-comments\"></i> View Feedback</a></li>
                <li><a href=\"";
        // line 28
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/orders\"><i class=\"fa fa-pencil-square\"></i> View Orders</a></li>
                <li><a href=\"";
        // line 29
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/clients\"><i class=\"fa fa-suitcase\"></i> Edit Clients</a></li>
                <li><a href=\"";
        // line 30
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/client-resources\"><i class=\"fa fa-files-o\"></i> Client Resources</a></li>
                <li><a href=\"";
        // line 31
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/invoices\"><i class=\"fa fa-envelope\"></i> Edit Invoices</a></li>
                <li><a href=\"";
        // line 32
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/preview-invoices\"><i class=\"fa fa-eye\"></i> Preview Invoices</a></li>
                <li><a href=\"";
        // line 33
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/projects\"><i class=\"fa fa-tasks\"></i> Edit Projects</a></li>
                <li><a href=\"";
        // line 34
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/preview-projects\"><i class=\"fa fa-eye\"></i> Preview Projects</a></li>
                <li><a href=\"";
        // line 35
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/users\"><i class=\"fa fa-users\"></i> Edit Users</a></li>
              </ul>
            </li>
            <li class=\"dropdown\">
              <a data-toggle=\"dropdown\" class=\"dropdown-toggle\" href=\"#\"><i class=\"fa fa-pencil-square-o\"></i> Writer Control Panel <b class=\"caret\"></b></a>
              <ul class=\"dropdown-menu\">
                <li><a href=\"";
        // line 41
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/writers\"><i class=\"fa fa-pencil\"></i> Edit Writers</a></li>
                <li><a href=\"";
        // line 42
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/opt_in\"><i class=\"fa fa-share-square\"></i> Edit Opt-ins</a></li>
                <li><a href=\"";
        // line 43
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/schedule\"><i class=\"fa fa-calendar\"></i> Writer Scheduler</a></li>
              </ul>
            </li>
          </ul>

          <ul class=\"nav navbar-nav navbar-right navbar-user\">
            <li class=\"dropdown user-dropdown\">
              <a data-toggle=\"dropdown\" class=\"dropdown-toggle\" href=\"#\"><i class=\"fa fa-user\"></i> Welcome ";
        // line 50
        echo twig_template_get_attributes($this, (isset($context["USER_INFO"]) ? $context["USER_INFO"] : null), "fullname");
        echo " <b class=\"caret\"></b></a>
              <ul class=\"dropdown-menu\">
                <li><a href=\"";
        // line 52
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/logout\"><i class=\"fa fa-power-off\"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
      <div id=\"page-wrapper\">
    ";
    }

    // line 61
    public function block_content($context, array $blocks = array())
    {
        // line 62
        echo "    ";
    }

    // line 64
    public function block_footer($context, array $blocks = array())
    {
        // line 65
        echo "      </div><!-- /#page-wrapper -->
  
    </div><!-- /#wrapper -->
    <script type=\"text/javascript\">
    <!--
        var site_url = \"";
        // line 70
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/\";
    //-->
    </script>
    ";
    }

    public function getTemplateName()
    {
        return "_common/base.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  201 => 70,  194 => 65,  191 => 64,  187 => 62,  184 => 61,  172 => 52,  167 => 50,  157 => 43,  153 => 42,  149 => 41,  140 => 35,  136 => 34,  132 => 33,  128 => 32,  124 => 31,  120 => 30,  116 => 29,  112 => 28,  108 => 27,  96 => 18,  90 => 14,  87 => 13,  82 => 78,  73 => 76,  69 => 75,  66 => 74,  64 => 64,  61 => 63,  59 => 61,  56 => 60,  54 => 13,  50 => 11,  41 => 9,  37 => 8,  33 => 7,  29 => 6,  22 => 1,);
    }
}

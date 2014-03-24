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
            echo "    <link type=\"text/css\" href=\"";
            echo (isset($context["css_import"]) ? $context["css_import"] : null);
            echo "\" rel=\"stylesheet\" />
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['css_import'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "</head>
<html>  
  <body>
  \t";
        // line 14
        $this->displayBlock('header', $context, $blocks);
        // line 45
        echo "        
    ";
        // line 46
        $this->displayBlock('content', $context, $blocks);
        // line 48
        echo "    
    ";
        // line 49
        $this->displayBlock('footer', $context, $blocks);
        // line 59
        echo "
    ";
        // line 60
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["JS"]) ? $context["JS"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["js_import"]) {
            // line 61
            echo "    <script type=\"text/javascript\" src=\"";
            echo (isset($context["js_import"]) ? $context["js_import"] : null);
            echo "\"></script>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['js_import'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 63
        echo "  </body>
</html>";
    }

    // line 14
    public function block_header($context, array $blocks = array())
    {
        // line 15
        echo "    <div id=\"wrapper\">
      <nav role=\"navigation\" class=\"navbar navbar-inverse navbar-fixed-top\">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class=\"navbar-header\">
          <a href=\"";
        // line 19
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/\" class=\"navbar-brand\">CEM Dashboard - Admin</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class=\"collapse navbar-collapse navbar-ex1-collapse\">
          <ul class=\"nav navbar-nav side-nav\">
            <li><a href=\"";
        // line 25
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/feedback\"><i class=\"fa fa-comments\"></i> View Feedback</a></li>
            <li><a href=\"";
        // line 26
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/orders\"><i class=\"fa fa-pencil-square\"></i> View Orders</a></li>
            <li><a href=\"";
        // line 27
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/clients\"><i class=\"fa fa-suitcase\"></i> Edit Clients</a></li>
            <li><a href=\"";
        // line 28
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/invoices\"><i class=\"fa fa-envelope\"></i> Edit Invoices</a></li>
            <li><a href=\"";
        // line 29
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/projects\"><i class=\"fa fa-tasks\"></i> Edit Projects</a></li>
            <li><a href=\"";
        // line 30
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/users\"><i class=\"fa fa-users\"></i> Edit Users</a></li>
          </ul>

          <ul class=\"nav navbar-nav navbar-right navbar-user\">
            <li class=\"dropdown user-dropdown\">
              <a data-toggle=\"dropdown\" class=\"dropdown-toggle\" href=\"#\"><i class=\"fa fa-user\"></i> ";
        // line 35
        echo twig_template_get_attributes($this, (isset($context["USER_INFO"]) ? $context["USER_INFO"] : null), "email");
        echo " <b class=\"caret\"></b></a>
              <ul class=\"dropdown-menu\">
                <li><a href=\"";
        // line 37
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

    // line 46
    public function block_content($context, array $blocks = array())
    {
        // line 47
        echo "    ";
    }

    // line 49
    public function block_footer($context, array $blocks = array())
    {
        // line 50
        echo "      </div><!-- /#page-wrapper -->
  
    </div><!-- /#wrapper -->
    <script type=\"text/javascript\">
    <!--
        var site_url = \"";
        // line 55
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
        return array (  168 => 55,  161 => 50,  158 => 49,  154 => 47,  151 => 46,  139 => 37,  134 => 35,  126 => 30,  122 => 29,  118 => 28,  114 => 27,  110 => 26,  106 => 25,  97 => 19,  91 => 15,  88 => 14,  83 => 63,  74 => 61,  70 => 60,  67 => 59,  65 => 49,  62 => 48,  60 => 46,  57 => 45,  55 => 14,  41 => 9,  33 => 7,  22 => 1,  50 => 11,  40 => 8,  37 => 8,  32 => 4,  29 => 6,);
    }
}

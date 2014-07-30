<?php

/* _common/base.html */
class __TwigTemplate_06fed7d0d69651642d45815032a1e718ca6abc326f2588cb584467c66db04577 extends Twig_Template
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
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
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
  <body>
    ";
        // line 13
        $this->displayBlock('header', $context, $blocks);
        // line 38
        echo "
    ";
        // line 39
        $this->displayBlock('content', $context, $blocks);
        // line 41
        echo "
    ";
        // line 42
        $this->displayBlock('footer', $context, $blocks);
        // line 63
        echo "
    ";
        // line 64
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["JS"]) ? $context["JS"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["js_import"]) {
            // line 65
            echo "    <script type=\"text/javascript\" src=\"";
            echo (isset($context["js_import"]) ? $context["js_import"] : null);
            echo "\"></script>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['js_import'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo "  </body>
</html>";
    }

    // line 13
    public function block_header($context, array $blocks = array())
    {
        // line 14
        echo "    <div id=\"welcome-wrapper\">
      <div id=\"welcome-container\" class=\"gray\">
          <span>Welcome ";
        // line 16
        echo twig_template_get_attributes($this, (isset($context["USER_INFO"]) ? $context["USER_INFO"] : null), "fullname");
        echo "!</span>
      </div>
    </div>
    <div id=\"logo\">
      <a href=\"http://www.contentequalsmoney.com\"><img src=\"";
        // line 20
        echo (isset($context["IMAGEPATH"]) ? $context["IMAGEPATH"] : null);
        echo "/_cem/FlatLogoCEM.png\" width=\"683\" border=\"0\" /></a>
    </div>
    <div id=\"wrap\">
      <div id=\"header\">
        <nav role=\"navigation\" class=\"navbar\">
          <div class=\"navbar-header\">
            <a href=\"";
        // line 26
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/\" class=\"btn btn-default navbar-btn\">HOME</a>
            <a href=\"";
        // line 27
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/projects\" class=\"btn btn-default navbar-btn\">VIEW PROJECT ASSIGNMENTS</a>
            <a href=\"";
        // line 28
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/feedback\" class=\"btn btn-default navbar-btn\">VIEW PROJECT FEEDBACK</a>
            <a href=\"";
        // line 29
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/schedule\" class=\"btn btn-default navbar-btn\">SET SCHEDULE</a>
            <a href=\"";
        // line 30
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/invoices\" class=\"btn btn-default navbar-btn\">VIEW INVOICE HISTORY</a>
            <a href=\"";
        // line 31
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/account\" class=\"btn btn-default navbar-btn\">EDIT ACCOUNT</a>
            <a href=\"";
        // line 32
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/logout\" class=\"btn btn-info navbar-btn\">LOG OUT</a>
          </div>
        </nav>
      </div>
      <div id=\"page-content\">
    ";
    }

    // line 39
    public function block_content($context, array $blocks = array())
    {
        // line 40
        echo "    ";
    }

    // line 42
    public function block_footer($context, array $blocks = array())
    {
        // line 43
        echo "      </div><!-- /#page-content -->

      <div id=\"footer-widgets\" class=\"footer-widgets\"></div>

      <div class=\"footer\" id=\"footer\">
        <div class=\"wrap\">    
            <p>&copy; Copyright ";
        // line 49
        echo (isset($context["COPY_YEAR"]) ? $context["COPY_YEAR"] : null);
        echo " <a href=\"http://contentequalsmoney.com/\">Content Equals Money</a> · All Rights Reserved</p>
        </div>
      </div>

    </div><!-- /#wrap -->
     <script type=\"text/javascript\">
    <!--
        /**
         * Site URL
         */
        var site_url = \"";
        // line 59
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/\";
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
        return array (  175 => 59,  162 => 49,  154 => 43,  151 => 42,  147 => 40,  144 => 39,  134 => 32,  130 => 31,  126 => 30,  122 => 29,  118 => 28,  114 => 27,  110 => 26,  101 => 20,  94 => 16,  90 => 14,  87 => 13,  82 => 67,  73 => 65,  69 => 64,  66 => 63,  64 => 42,  61 => 41,  59 => 39,  56 => 38,  54 => 13,  50 => 11,  41 => 9,  37 => 8,  33 => 7,  29 => 6,  22 => 1,  177 => 136,  145 => 107,  113 => 78,  80 => 48,  48 => 19,  31 => 4,  28 => 3,);
    }
}

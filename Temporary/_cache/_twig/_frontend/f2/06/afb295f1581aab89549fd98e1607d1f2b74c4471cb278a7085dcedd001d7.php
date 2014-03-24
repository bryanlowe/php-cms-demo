<?php

/* _common/base.html */
class __TwigTemplate_f206afb295f1581aab89549fd98e1607d1f2b74c4471cb278a7085dcedd001d7 extends Twig_Template
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
<html>  
  <body>
    ";
        // line 14
        $this->displayBlock('header', $context, $blocks);
        // line 36
        echo "
    ";
        // line 37
        $this->displayBlock('content', $context, $blocks);
        // line 39
        echo "
    ";
        // line 40
        $this->displayBlock('footer', $context, $blocks);
        // line 61
        echo "
    ";
        // line 62
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["JS"]) ? $context["JS"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["js_import"]) {
            // line 63
            echo "    <script type=\"text/javascript\" src=\"";
            echo (isset($context["js_import"]) ? $context["js_import"] : null);
            echo "\"></script>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['js_import'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 65
        echo "  </body>
</html>";
    }

    // line 14
    public function block_header($context, array $blocks = array())
    {
        // line 15
        echo "    <div id=\"welcome-wrapper\">
      <div id=\"welcome-container\" class=\"texture stitch\">
          <span>Welcome ";
        // line 17
        echo twig_template_get_attributes($this, (isset($context["USER_INFO"]) ? $context["USER_INFO"] : null), "user_name");
        echo "!</span>
          <div id=\"welcome-shadow\"></div>
      </div>
    </div>
    <div id=\"wrap\">
      <div id=\"header\">
        <nav role=\"navigation\" class=\"navbar\">
          <div class=\"navbar-header\">
            <a href=\"";
        // line 25
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/feedback\" class=\"btn btn-default navbar-btn\">SUBMIT FEEDBACK</a>
            <a href=\"";
        // line 26
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/orders\" class=\"btn btn-default navbar-btn\">PLACE AN ORDER</a>
            <a href=\"";
        // line 27
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/projects\" class=\"btn btn-default navbar-btn\">VIEW PROJECT DETAILS</a>
            <a href=\"";
        // line 28
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/invoices\" class=\"btn btn-default navbar-btn\">VIEW INVOICE HISTORY</a>
            <a href=\"";
        // line 29
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/account\" class=\"btn btn-default navbar-btn\">EDIT ACCOUNT</a>
            <a href=\"";
        // line 30
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/logout\" class=\"btn btn-info navbar-btn\">LOG OUT</a>
          </div>
        </nav>
      </div>
      <div id=\"page-content\">
    ";
    }

    // line 37
    public function block_content($context, array $blocks = array())
    {
        // line 38
        echo "    ";
    }

    // line 40
    public function block_footer($context, array $blocks = array())
    {
        // line 41
        echo "      </div><!-- /#page-content -->

      <div id=\"footer-widgets\" class=\"footer-widgets\"></div>

      <div class=\"footer\" id=\"footer\">
        <div class=\"wrap\">    
            <p>&copy; Copyright ";
        // line 47
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
        // line 57
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
        return array (  167 => 57,  154 => 47,  146 => 41,  143 => 40,  139 => 38,  136 => 37,  126 => 30,  122 => 29,  118 => 28,  114 => 27,  110 => 26,  106 => 25,  95 => 17,  91 => 15,  88 => 14,  83 => 65,  74 => 63,  70 => 62,  67 => 61,  65 => 40,  62 => 39,  60 => 37,  57 => 36,  55 => 14,  50 => 11,  41 => 9,  37 => 8,  33 => 7,  29 => 6,  22 => 1,);
    }
}

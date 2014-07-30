<?php

/* _common/header_login.html */
class __TwigTemplate_ffd29f63b3c6922abbb9c83232334e27ac9ec2e9c85aded532874e8a32a21647 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "  <body>
    <div id=\"welcome-wrapper\">
      <div id=\"welcome-container\" class=\"gray\"></div>
    </div>
    <div id=\"logo\">
      <a href=\"http://www.contentequalsmoney.com\"><img src=\"";
        // line 6
        echo (isset($context["IMAGEPATH"]) ? $context["IMAGEPATH"] : null);
        echo "/_cem/FlatLogoCEM.png\" width=\"683\" border=\"0\" /></a>
    </div>
    <div id=\"wrap\">
      <div id=\"header\">
        <nav role=\"navigation\" class=\"navbar\">
          <div class=\"navbar-header\">
            <a href=\"";
        // line 12
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/login\" class=\"btn btn-info navbar-btn\">LOG IN</a>
          </div>
        </nav>
      </div>
      <div id=\"page-content\">";
    }

    public function getTemplateName()
    {
        return "_common/header_login.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 12,  26 => 6,  19 => 1,  50 => 16,  40 => 8,  37 => 7,  32 => 4,  29 => 3,);
    }
}

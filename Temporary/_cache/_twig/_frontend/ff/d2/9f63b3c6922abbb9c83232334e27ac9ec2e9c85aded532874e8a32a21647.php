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
        return array (  35 => 12,  26 => 6,  19 => 1,  175 => 59,  162 => 49,  154 => 43,  151 => 42,  147 => 40,  144 => 39,  134 => 32,  130 => 31,  126 => 30,  122 => 29,  118 => 28,  114 => 27,  110 => 26,  101 => 20,  94 => 16,  90 => 14,  87 => 13,  82 => 67,  73 => 65,  69 => 64,  66 => 63,  64 => 42,  61 => 41,  59 => 39,  56 => 38,  54 => 13,  50 => 11,  41 => 9,  33 => 7,  22 => 1,  40 => 8,  37 => 8,  32 => 4,  29 => 6,);
    }
}

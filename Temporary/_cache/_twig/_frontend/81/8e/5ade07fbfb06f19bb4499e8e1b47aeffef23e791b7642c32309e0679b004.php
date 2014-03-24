<?php

/* _common/header_login.html */
class __TwigTemplate_818e5ade07fbfb06f19bb4499e8e1b47aeffef23e791b7642c32309e0679b004 extends Twig_Template
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
        echo "<html>  
  <body>
    <div id=\"welcome-wrapper\">
      <div id=\"welcome-container\" class=\"texture stitch\">
          <div id=\"welcome-shadow\"></div>
      </div>
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
        return array (  19 => 1,  50 => 16,  40 => 8,  37 => 7,  32 => 12,  29 => 3,);
    }
}

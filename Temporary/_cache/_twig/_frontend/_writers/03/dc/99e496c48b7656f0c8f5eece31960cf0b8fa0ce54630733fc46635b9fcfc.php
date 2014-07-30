<?php

/* _common/header_plain.html */
class __TwigTemplate_03dc99e496c48b7656f0c8f5eece31960cf0b8fa0ce54630733fc46635b9fcfc extends Twig_Template
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
        echo "
    <div id=\"welcome-wrapper\">
      <div id=\"welcome-container\" class=\"gray\"></div>
    </div>
    <div id=\"logo\">
      <!--a href=\"http://www.contentequalsmoney.com\"><img src=\"/Application/_includes/_images/_cem/FlatLogoCEM.png\" width=\"683\" border=\"0\" /></a-->
    </div>
    <div id=\"wrap\">
      <div id=\"header\">
        <nav role=\"navigation\" class=\"navbar\">
          <div class=\"navbar-header\"></div>
        </nav>
      </div>
      <div id=\"page-content\">";
    }

    public function getTemplateName()
    {
        return "_common/header_plain.html";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}

<?php

/* _common/header_login.html */
class __TwigTemplate_7e3630f023f50e3f9ef34c5817282f2f38ab916aabcfb49ff4b46ff9bdca5742 extends Twig_Template
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
        echo "<body>
  <div id=\"wrapper\">
    <nav role=\"navigation\" class=\"navbar navbar-inverse navbar-fixed-top\">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class=\"navbar-header\">
        <a href=\"";
        // line 6
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/\" class=\"navbar-brand\">CEM Dashboard - Admin</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class=\"collapse navbar-collapse navbar-ex1-collapse\">
        <ul class=\"nav navbar-nav side-nav\"></ul>

        <ul class=\"nav navbar-nav navbar-right navbar-user\">
          <li class=\"dropdown user-dropdown\">
            <a data-toggle=\"dropdown\" class=\"dropdown-toggle\" href=\"#\"><i class=\"fa fa-user\"></i> Please Log In <b class=\"caret\"></b></a>
            <ul class=\"dropdown-menu\">
              <li><a href=\"";
        // line 17
        echo (isset($context["SITE_URL"]) ? $context["SITE_URL"] : null);
        echo "/admin/login\"><i class=\"fa fa-power-off\"></i> Log In</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav>
    <div id=\"page-wrapper\">";
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
        return array (  26 => 6,  19 => 1,  50 => 16,  40 => 17,  37 => 7,  32 => 4,  29 => 3,);
    }
}

<?php

/* login/main.html */
class __TwigTemplate_1ce05f210060354bf696397d8440add43f8969dd3815f576d42038fe366a73f9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("_common/base.html");

        $this->blocks = array(
            'header' => array($this, 'block_header'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "_common/base.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_header($context, array $blocks = array())
    {
        // line 4
        echo "\t";
        $this->env->loadTemplate("_common/header_login.html")->display($context);
    }

    // line 7
    public function block_content($context, array $blocks = array())
    {
        // line 8
        echo "<div class=\"container\">
\t<div class=\"row login-form\">
\t\t<div class=\"col-lg-4 col-lg-offset-4\">
\t\t\t<div class=\"panel panel-primary\">
\t\t\t\t<div class=\"panel-heading\">
\t\t\t\t\t<h3 class=\"panel-title\">Log In</h3>
\t\t\t\t</div>
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t";
        // line 16
        echo (isset($context["LOGIN_FORM"]) ? $context["LOGIN_FORM"] : null);
        echo "
\t\t\t\t\t<p>Forgot your password? No problem! <a href=\"/writers/forgot-password\">Reset it here!</a></p>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "login/main.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 16,  40 => 8,  37 => 7,  32 => 4,  29 => 3,);
    }
}
